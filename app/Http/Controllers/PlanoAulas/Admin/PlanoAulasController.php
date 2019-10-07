<?php

namespace App\Http\Controllers\PlanoAulas\Admin;

use App\Conteudo;
use App\Entities\GradeAula\GradeAula;
use App\Entities\PlanoAula\PlanoAula;
use App\Entities\PlanoAula\PlanoAulaAnexo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PlanoAulasController extends Controller
{

    private function gradeAulas()
    {
        return GradeAula::where('user_id', Auth::user()->id)->select('titulo', 'id', 'recorrente', 'dia', 'data')->get();
    }

    private function conteudos()
    {
        return Conteudo::select('id', 'titulo')->get();
    }

    private function checkAndStoreAnexos($request, $planoAulaId, $update = null)
    {
        $checkAtividades = array_key_exists('atividades', $request->all());
        $checkMateriais = array_key_exists('materiais', $request->all());

        if ($update === true) {

            if ($checkAtividades) {
                PlanoAulaAnexo::where('plano_aula_id', $planoAulaId)->where('tipo', 1)->delete();
                foreach ($request->get('atividades') as $atividade) {
                    PlanoAulaAnexo::create([
                        'tipo'          => 1,
                        'plano_aula_id' => $planoAulaId,
                        'conteudo_id'   => $atividade
                    ]);
                }
            } else {
                PlanoAulaAnexo::where('plano_aula_id', $planoAulaId)->where('tipo', 1)->delete();
            }

            if ($checkMateriais) {
                PlanoAulaAnexo::where('plano_aula_id', $planoAulaId)->where('tipo', 2)->delete();
                foreach ($request->get('materiais') as $material) {
                    PlanoAulaAnexo::create([
                        'tipo'          => 2,
                        'plano_aula_id' => $planoAulaId,
                        'conteudo_id'   => $material
                    ]);
                }
            } else {
                PlanoAulaAnexo::where('plano_aula_id', $planoAulaId)->where('tipo', 2)->delete();
            }

        }

        if ($checkAtividades) {
            foreach ($request->get('atividades') as $atividade) {
                PlanoAulaAnexo::create([
                    'tipo'          => 1,
                    'plano_aula_id' => $planoAulaId,
                    'conteudo_id'   => $atividade
                ]);
            }
        }

        if ($checkMateriais) {
            foreach ($request->get('materiais') as $material) {
                PlanoAulaAnexo::create([
                    'tipo'          => 2,
                    'plano_aula_id' => $planoAulaId,
                    'conteudo_id'   => $material
                ]);
            }
        }
    }

    private function checkAnoSession($value)
    {
        // Verifica se já existe uma session
        if (Session::has('anos')) {

            // verifica se o valor enviado já existe na session
            if (in_array($value, Session::get('anos'))) {
                $session = Session::get('anos');
                Session::forget('anos');
                Session::put('anos', array_diff($session, [$value]));
            } else {
                // adiciona novo item na sessão
                Session::push('anos', $value);
            }
        } else {
            //Se não existir, cria nova sessão
            Session::put('anos', [$value]);
        }

        // retorna os itens da sessão
        return Session::get('anos');
    }

    private function checkDisciplinaSession($value)
    {
        // Verifica se já existe uma session
        if (Session::has('disciplina')) {

            // verifica se o valor enviado já existe na session
            if (in_array($value, Session::get('disciplina'))) {
                $session = Session::get('disciplina');
                Session::forget('disciplina');
                Session::put('disciplina', array_diff($session, [$value]));
            } else {
                // adiciona novo item na sessão
                Session::push('disciplina', $value);
            }
        } else {
            //Se não existir, cria nova sessão
            Session::put('disciplina', [$value]);
        }

        // retorna os itens da sessão
        return Session::get('disciplina');
    }


    public function getDaysAjax($idGrade)
    {
        $dates = [];
        $checkDates = PlanoAula::where('grade_aula_id', $idGrade)->select('data')->get();
        foreach ($checkDates as $check) {
            $dates[] = date('d/m/Y', strtotime($check->data));
        }
        return $dates;
    }


    public function index()
    {
        Session::forget(['anos', 'disciplina']);
        $gradeAulas = $this->gradeAulas();
        $planos = PlanoAula::where('user_id', Auth::user()->id)->latest('created_at')->paginate(5);
        $anos = PlanoAula::select('ano_serie')->groupBy('ano_serie')->get();
        $disciplinas = PlanoAula::select('materia')->groupBy('materia')->get();
        $conteudos = $this->conteudos();
        return view('pages.plano-aulas.admin.index', compact('gradeAulas', 'planos', 'conteudos', 'anos', 'disciplinas'));
    }


    public function filtrar(Request $request)
    {
        if ($request->get('input-ano')) {
            $filterAno = $this->checkAnoSession($request->get('input-ano'));
            $planos = PlanoAula::where('user_id', Auth::user()->id)
                ->whereIn('ano_serie', $filterAno)
                ->latest('created_at')->paginate(5);
            if (empty($filterAno)) {
                return redirect()->route('gestao.plano-aulas.listar');
            }
        }
        if ($request->get('input-disciplina')) {
            $filterDisciplina = $this->checkDisciplinaSession($request->get('input-disciplina'));
            $planos = PlanoAula::where('user_id', Auth::user()->id)
                ->whereIn('materia', $filterDisciplina)
                ->latest('created_at')->paginate(5);
            if (empty($filterDisciplina)) {
                return redirect()->route('gestao.plano-aulas.listar');
            }
        }

        if (Session::has('anos') && Session::has('disciplina')) {
            $planos = PlanoAula::where('user_id', Auth::user()->id)
                ->whereIn('ano_serie', Session::get('anos'), 'and')
                ->whereIn('materia', Session::get('disciplina'))
                ->latest('created_at')->paginate(5);
        }

        $gradeAulas = $this->gradeAulas();
        $anos = PlanoAula::select('ano_serie')->groupBy('ano_serie')->get();
        $disciplinas = PlanoAula::select('materia')->groupBy('materia')->get();
        $conteudos = $this->conteudos();
        return view('pages.plano-aulas.admin.index', compact('gradeAulas', 'planos', 'conteudos', 'anos', 'disciplinas'));
    }

    public function busca(Request $request)
    {
        Session::forget(['anos', 'disciplina']);
        $gradeAulas = $this->gradeAulas();
        $anos = PlanoAula::select('ano_serie')->groupBy('ano_serie')->get();
        $disciplinas = PlanoAula::select('materia')->groupBy('materia')->get();
        $conteudos = $this->conteudos();
        $planos = PlanoAula::where('user_id', Auth::user()->id)
            ->where('assunto', 'LIKE', '%' . $request->get('search') . '%')
            ->latest('created_at')->paginate(5);
        return view('pages.plano-aulas.admin.index', compact('gradeAulas', 'planos', 'conteudos', 'anos', 'disciplinas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'grade_aula_id' => 'required',
            'assunto'       => 'required',
            'tarefa_classe' => 'required'
        ]);
        $values = $request->all();
        $values['user_id'] = Auth::user()->id;

        if ($request->get('data')) {
            $values['data'] = date('Y-m-d', strtotime($request->get('data')));
        } else {
            $values['data'] = GradeAula::find($request->get('grade_aula_id'))->data;
        }

        $planoAulaId = PlanoAula::create($values)->id;
        $this->checkAndStoreAnexos($request, $planoAulaId);
        return redirect()->route('gestao.plano-aulas.listar')->with('message', 'Plano de aula cadastrado com sucesso!');
    }

    public function update($idPlano, Request $request)
    {
        $this->validate($request, [
            'grade_aula_id' => 'required',
            'assunto'       => 'required',
            'tarefa_classe' => 'required'
        ]);
        $values = $request->all();
        if ($request->get('data')) {
            $values['data'] = date('Y-m-d', strtotime($request->get('data')));
        } else {
            $values['data'] = GradeAula::find($request->get('grade_aula_id'))->data;
        }
        PlanoAula::find($idPlano)->update($values);
        $this->checkAndStoreAnexos($request, $idPlano, true);
        return redirect()->route('gestao.plano-aulas.listar')->with('message', 'Plano de aula atualizado com sucesso!');
    }


    public function delete(Request $request)
    {
        PlanoAula::find($request->idPlano)->delete();
        return redirect()->route('gestao.plano-aulas.listar')->with('message', 'Plano de aula excluído com sucesso!');
    }


}
