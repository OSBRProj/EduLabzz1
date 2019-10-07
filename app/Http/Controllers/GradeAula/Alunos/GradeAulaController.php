<?php

namespace App\Http\Controllers\GradeAula\Alunos;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entities\GradeAula\GradeAula;
use Illuminate\Support\Facades\DB;


class GradeAulaController extends Controller
{

    private function getAluno()
    {
        return User::find(Auth::user()->id);
    }

    private function getTurmas()
    {
        return $turmas = $this->getAluno()->turmas_aluno;
    }

    private function getAulas($date, $turma)
    {

        $dayOfWeek = Carbon::createFromFormat('Y-m-d', $date)->dayOfWeek;
        if ($turma === "todas") {
            $turmasId = [];
            foreach ($this->getAluno()->turmas_aluno as $turma) {
                $turmasId[] = $turma->turma_id;
            }

            // Retorna as grades de aula relacionadas a todas as turmas que o aluno faz parte.
            return GradeAula::whereIn('turma_id', $turmasId)
                ->where(function ($query) use ($dayOfWeek, $date) {
                    $query->where([['recorrente', 0], ['data', $date]]);
                    $query->orWhere([['recorrente', 1], ['dia', $dayOfWeek]]);
                })->with('planos')->get();
        }

        // Retorna as grades de aula relacionada a uma turma.
        return GradeAula::where('turma_id', $turma)->where(function ($query) use ($dayOfWeek, $date) {
            $query->where([['recorrente', 0], ['data', $date]]);
            $query->orWhere([['recorrente', 1], ['dia', $dayOfWeek]]);
        })->get();
    }


    public function index($date, $turma)
    {
        $aulas = $this->getAulas($date, $turma);
        $turmas = $this->getTurmas();
        $turmaUrl = request()->segment(5);
        return view('pages.grade-aulas.alunos.index', compact('aulas', 'turmas', 'turmaUrl', 'date'));
    }
}
