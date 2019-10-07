<?php

namespace App\Http\Controllers\GradeAula\Admin;

use App\AlunoTurma;

use App\Entities\GradeAula\GradeAula;
use App\Turma;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class GradeAulaController extends Controller
{
    private function getCalendar($idTurma)
    {
        $events = [];
        $data = GradeAula::where('user_id', Auth::user()->id)->where('turma_id', $idTurma)->get();
        if ($data->count()) {
            foreach ($data as $key => $value) {
                $opts = [
                    'color'       => "$value->cor",
                    'textColor'   => '#FFFFFF',
                    'description' => $value->descricao,
                    'dow'         => [$value->dia],
                    'ranges'      => [$value->dia => ['start' => "$value->data_inicial", 'end' => '']]
                ];

                if ($value->recorrente == 0)
                {
                    unset($opts['dow']);
                    unset($opts['ranges']);
                }

                $events[] = Calendar::event(
                    $value->titulo,
                    false,
                    $value->data_inicial,
                    $value->data_final,
                    $value->id,
                    $opts
                );
            }
        }
        $calendar = Calendar::addEvents($events)->setOptions([
            'columnFormat'    => 'ddd D',
            'allDaySlot'      => false,
            'defaultView'     => 'agendaWeek',
            'slotLabelFormat' => 'HH:mm',
            'minTime'         => '06:00:00',
            'maxTime'         => '24:00:00',
            'slotDuration'    => '01:00:00',
            'locale'          => 'pt-br',
            'contentHeight'   => 'auto',
            'firstDay'        => 0, // inicia na segunda
        ])->setCallbacks([
            'dayClick'   => 'function(date){
                $(".modal-body #dateCalendarInput").val( date.format("DD/MM/YYYY") );
                $(".modal-body #hourInitialCalendarInput").val( date.format("HH:mm") );
                $(".modal-body #hourFinalCalendarInput").val( date.add(1, "hour").format("HH:mm") );
                $("#novaGrade").modal("show");
            }',
            'eventClick' => 'function(event) {

                $(".modal-body #idCalendar").val( event.id );

                if(event.ranges !== undefined){
                    $("input#dateRangesYes").prop("checked", true);
                }

                if(event.ranges == undefined){
                    $("input#dateRangesNo").prop("checked", true);
                }

                $(".modal-body #editSemana").val(event.start.format("DD/MM/YYYY"));
                $(".modal-body #editHourInitial").val(event.start.format("HH:mm"));
                $(".modal-body #editHourFinal").val(event.end.format("HH:mm"));

                $(".modal-body #removeGrade").attr("data-id", event.id);
                $(".modal-body #tituloCalendar").val( event.title );
                $(".modal-body #descricaoCalendar").val( event.description );
                $(".modal-body #dateShowCalendar").html( event.title + " - " + event.start.format("DD/MM/YYYY [às] HH:mm")  );
                $("#editaGrade").modal("show");
            }'
        ]);

        return $calendar;
    }


    private function checkDate($idTurma, $recorrente, $data, $horaInicial, $horaFinal, $dia)
    {
        $check = GradeAula::where(function ($query) use ($idTurma, $recorrente, $data, $horaInicial, $horaFinal, $dia) {
            if ($recorrente == true) {
                $query->where([['dia', '=', $dia], ['hora_inicial', '>=', $horaInicial], ['hora_inicial', '<=', $horaInicial]]);
                $query->orWhere([['dia', '=', $dia], ['hora_final', '>=', $horaFinal], ['hora_final', '<=', $horaFinal]]);
            } else {
                $query->where([['data', '=', $data], ['hora_inicial', '>=', $horaInicial], ['hora_inicial', '<=', $horaInicial]]);
                $query->orWhere([['data', '=', $data], ['hora_final', '>=', $horaFinal], ['hora_final', '<=', $horaFinal]]);
            }
        })->where('turma_id', $idTurma)->exists();
        return $check;
    }


    public function listar($idTurma)
    {
        $calendar = $this->getCalendar($idTurma);
        if (Turma::find($idTurma) == null) {
            Redirect::back()->withErrors(['Turma não encontrada!']);
        } else {
            $turma = Turma::with('professor', 'postagens_comentarios', 'escola')->find($idTurma);

            if (strpos(Auth::user()->permissao, "G") === false && strpos(Auth::user()->permissao, "Z") === false && $turma->user_id != Auth::user()->id && (AlunoTurma::where([['turma_id', '=', $idTurma], ['user_id', '=', Auth::user()->id]])->first() == null)) {
                Session::flash('error', 'Você não faz parte desta turma!');
                return redirect()->route('catalogo');
            }
            return view('gestao.grades-aula.turmas-grade-aula')->with(compact('turma', 'calendar'));
        }
    }


    public function nova($idTurma, Request $request)
    {
        $this->validate($request, [
            'titulo'       => 'required',
            'data'         => 'required',
            'data_inicial' => 'required',
            'data_final'   => 'required'
        ]);

        // Recupera data do input e coloca no formato Y-m-d
        $date = Carbon::createFromFormat('d/m/Y', $request->get('data'))->format('Y-m-d');

        // Recupera o dia da semana DOW, 1 (para Segunda) até 7 (para Domingo)
        $dow = Carbon::createFromFormat('d/m/Y', $request->get('data'))->format('N');

        $startDate = $date . ' ' . $request->get('data_inicial');
        $finalDate = $date . ' ' . $request->get('data_final');


        //verifica se a hora final selecionada é a mesma que a hora inicial
        if ($request->get('data_inicial') == $request->get('data_final')) {
            return redirect()->back()->withErrors(['A hora final não pode ser a mesma que a hora inicial']);
        }

        // verifica se a data selecionada pode ser gravada
        if ($this->checkDate($idTurma, $request->get('recorrente'), $date, $request->get('data_inicial'), $request->get('data_final'), $dow)) {
            return redirect()->back()->withErrors(['Esta data e horário já está sendo usada']);
        }


        GradeAula::create([
            'user_id'      => Auth::user()->id,
            'turma_id'     => $idTurma,
            'titulo'       => $request->get('titulo'),
            'descricao'    => $request->get('descricao'),
            'data'         => $date,
            'data_inicial' => $startDate,
            'data_final'   => $finalDate,
            'hora_inicial' => $request->get('data_inicial'),
            'hora_final'   => $request->get('data_final'),
            'recorrente'   => $request->get('recorrente'),
            'dia'          => $dow,
            'cor'          => $request->get('cor')
        ]);

        return redirect()->route('gestao.grade-listar', $idTurma)->with('message', 'Grade de aula cadastrada com sucesso!');
    }


    public function atualizar(Request $request)
    {
        $this->validate($request, ['titulo' => 'required']);

        //verifica se a hora final selecionada é a mesma que a hora inicial
        if ($request->get('data_inicial') == $request->get('data_final')) {
            return redirect()->back()->withErrors(['A hora final não pode ser a mesma que a hora inicial']);
        }

        $grade_aula = GradeAula::find($request->get('id'));

        $cor = $grade_aula->cor;
        if ($request->get('cor')) {
            $cor = $request->get('cor');
        }

        // Recupera data do input e coloca no formato Y-m-d
        $date = Carbon::createFromFormat('d/m/Y', $request->get('data'))->format('Y-m-d');

        // Recupera o dia da semana DOW, 1 (para Segunda) até 7 (para Domingo)
        $dow = Carbon::createFromFormat('d/m/Y', $request->get('data'))->format('N');

        $startDate = $date . ' ' . $request->get('data_inicial');
        $finalDate = $date . ' ' . $request->get('data_final');

        $grade_aula->update([
            'titulo'       => $request->get('titulo'),
            'descricao'    => $request->get('descricao'),
            'data'         => $date,
            'data_inicial' => $startDate,
            'data_final'   => $finalDate,
            'hora_inicial' => $request->get('data_inicial'),
            'hora_final'   => $request->get('data_final'),
            'cor'          => $cor,
            'recorrente'   => $request->get('recorrente'),
            'dia'          => $dow
        ]);
        return redirect()->route('gestao.grade-listar', $request->get('idTurma'))->with('message', 'Grade de aula cadastrada com sucesso!');
    }


    public function deletar(Request $request)
    {
        GradeAula::find($request->get('idGrade'))->delete();
        return redirect()->back()->with('message', 'Registro excluído com sucesso!');
    }
}
