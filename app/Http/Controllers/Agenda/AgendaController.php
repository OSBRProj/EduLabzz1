<?php

namespace App\Http\Controllers\Agenda;

use App\Entities\Agenda\Agenda;
use App\Entities\GradeAula\GradeAula;
use App\Turma;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class AgendaController extends Controller
{

    private function getAgendaPessoal()
    {
        $agendaPessoal = [];

        $dataAgendaPessoal = Agenda::where('user_id', Auth::user()->id)->get();

        foreach ($dataAgendaPessoal as $key => $value) {
            $agendaPessoal[] = Calendar::event(
                $value->titulo,
                false,
                $value->data_inicial,
                $value->data_final,
                $value->id,
                [
                    'color' => "$value->cor",
                    'textColor' => '#FFFFFF',
                    'description' => $value->descricao,
                ]
            );
        }
        return $agendaPessoal;
    }


    private function getCalendars($idTurma = null, $pessoal = false, $mesclar = false)
    {
        $opts = [
            'firstDay' => 1, // inicia na segunda
            'columnFormat' => 'ddd D',
            'allDaySlot' => false,
            'defaultView' => 'agendaWeek',
            'slotLabelFormat' => 'HH:mm',
            'locale' => 'pt-br',
            'contentHeight' => 'auto'
        ];

        $setCallbacks = [
            'dayClick' => 'function(date){
                $(".modal-body #dateCalendar").val( date.format("DD/MM/YYYY HH:mm") );
                $(".modal-body #dateCalendarInput").val( date.format("DD/MM/YYYY") );
                $(".modal-body #hourCalendarInput").val( date.format("HH:mm") );
                $("#novaAgenda").modal("show");
            }',
            'eventClick' => 'function(event, date) {
                $(".modal-body #idCalendar").val( event.id );
                $(".modal-body #dateCalendarEditInput").val(event.start.format("DD/MM/YYYY"));
                $(".modal-body #hourCalendarInput").val(event.start.format("HH:mm"));
                $(".modal-body #tituloCalendar").val( event.title );
                $(".modal-body #descricaoCalendar").val( event.description );
                $(".modal-body #dateShowCalendar").html( event.start.format("DD/MM/YYYY HH:mm") );
                $(".modal-body #removeAgenda").attr("data-id", event.id);
                $("#editaAgenda").modal("show");
            }'
        ];


        if ($pessoal == true) {
            $opts['hiddenDays'] = [0];
            $opts['minTime'] = '05:00:00';
            $opts['maxTime'] = '23:00:00';
            $opts['slotDuration'] = '01:00:00';

            $calendar = Calendar::addEvents($this->getAgendaPessoal())->setOptions($opts)->setCallbacks($setCallbacks);
        }

        if ($idTurma !== null) {
            $opts['minTime'] = '05:00:00';
            $opts['maxTime'] = '23:00:00';
            $opts['slotDuration'] = '01:00:00';
            $setCallbacks = [];
            $agendaTurma = [];

            if (is_array($idTurma)) {
                // grade de aulas relacionada a mais de uma turma
                $dataTurma = GradeAula::whereIn('turma_id', $idTurma)->get();
            } else {
                // grade de aulas relacionadas a uma turma
                $dataTurma = GradeAula::where('turma_id', $idTurma)->get();
            }

            foreach ($dataTurma as $key => $value) {
                $extras = [
                    'color' => "$value->cor",
                    'textColor' => '#FFFFFF',
                    'description' => $value->descricao,
                    'dow' => [$value->dia],
                    'ranges' => [$value->dia => ['start' => "$value->data_inicial", 'end' => '']]
                ];
                if ($value->recorrente == 0) {
                    unset($extras['dow']);
                    unset($extras['ranges']);
                }
                $agendaTurma[] = Calendar::event(
                    $value->titulo,
                    false,
                    $value->data_inicial,
                    $value->data_final,
                    $value->id,
                    $extras
                );
            }
            if ($mesclar == 'true') {
                $calendar = Calendar::addEvents($agendaTurma)->addEvents($this->getAgendaPessoal())->setOptions($opts)->setCallbacks($setCallbacks);
            } else {
                $calendar = Calendar::addEvents($agendaTurma)->setOptions($opts)->setCallbacks($setCallbacks);
            }

        }

        return $calendar;
    }

    private function getTurmas()
    {
        $aluno = User::find(Auth::user()->id);
        return $turmas = $aluno->turmas_aluno;
    }

    public function index()
    {
        $turmas = $this->getTurmas();

        // lista apenas registros da agenda pessoal
        $calendar = $this->getCalendars(null, true);

        return view('pages.agenda.index', compact('calendar', 'turmas'));
    }


    public function filterCalendar($idTurma, $mesclar)
    {
        $turmas = $this->getTurmas();

        /*
         * Verifica se o usuario clicou em todas as turmas
         * Recupera os ids das turmas relacionada ao usuário
         */
        if ($idTurma == 'todas') {
            $idsTurmas = [];
            foreach ($turmas as $turma) {
                $idsTurmas[] = $turma->turma_id;
            }
            $calendar = $this->getCalendars($idsTurmas, false, $mesclar);
            $nomeTurma = "Todas as turmas";
        }

        if ($idTurma !== 'todas') {
            $calendar = $this->getCalendars($idTurma, false, $mesclar);
            $nomeTurma = Turma::find($idTurma)->titulo;
        }


        return view('pages.agenda.index', compact('calendar', 'turmas', 'nomeTurma', 'idTurma'));
    }


    public function store(Request $request)
    {
        $startDate = Carbon::createFromFormat('d/m/Y', $request->get('date'))->format('Y-m-d') . ' ' . $request->get('hour');
        $endDate = Carbon::parse($startDate)->addHours(1)->format('Y-m-d H:s');
        Agenda::create([
            'data_inicial' => $startDate,
            'data_final' => $endDate,
            'titulo' => $request->get('titulo'),
            'descricao' => $request->get('descricao'),
            'cor' => $request->get('cor'),
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('agenda.index')->with('message', 'Agenda cadastrada com sucesso!');
    }


    public function update(Request $request)
    {
        $startDate = Carbon::createFromFormat('d/m/Y', $request->get('date'))->format('Y-m-d') . ' ' . $request->get('hour');
        $endDate = Carbon::parse($startDate)->addHours(1)->format('Y-m-d H:s');

        Agenda::find($request->get('id'))->update([
            'data_inicial' => $startDate,
            'data_final' => $endDate,
            'titulo' => $request->get('titulo'),
            'descricao' => $request->get('descricao'),
            'cor' => (!empty($request->get('cor')) ? $request->get('cor') : Agenda::find($request->get('id'))->cor)
        ]);
        return redirect()->route('agenda.index')->with('message', 'Agenda atualizada com sucesso!');
    }


    public function delete(Request $request)
    {
        Agenda::find($request->get('idAgenda'))->delete();
        return redirect()->route('agenda.index')->with('message', 'Registro excluído com sucesso!');

    }

}
