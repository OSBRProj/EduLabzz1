<?php

namespace App\Http\Controllers\Estatisticas\Alunos;

use App\Entities\HabilidadeUsuario\HabilidadeUsuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Entities\GradeAula\GradeAula;

use App\AlunoTurma;
use App\Entities\GamificacaoUsuario\GamificacaoUsuario;
use App\Escola;
use App\Turma;
use App\User;

class EstatisticasController extends Controller
{
    public function index()
    {
        // dd("Home");

        // \App\Services\GamificacaoService::loginIncrement();
        // \App\Services\GamificacaoService::incrementUserXP(1);

        $habilidades = HabilidadeUsuario::where('user_id', Auth::user()->id)->count();

        $aulas = $this->getAulas(date("Y-m-d"), "todas");

        // dd($aulas);

        $usersXps = User::with('gamificacao')
        // where([['permissao', '=', 'A']])
        ->get()
        ->sortByDesc('gamificacao.xp')->values();

        // $usersXps = GamificacaoUsuario::select('user_id', 'xp')
        //     ->orderBy('xp', 'DESC')
        //     ->limit(20)
        //     ->get();

        $escolas = Escola::all();

        foreach ($escolas as $key => $escola)
        {
            $total = 0;

            foreach ($escola->alunos as $key => $aluno)
            {
                if($aluno->gamificacao != null)
                {
                    $total += $aluno->gamificacao->sum('xp');
                }
            }

            $escola->xp = $total;
        }

        $escolas = $escolas->sortByDesc('xp')->values();

        $turmas = Turma::with('alunos.user.gamificacao')->whereHas('alunos.user')->get();

        foreach ($turmas as $key => $turma)
        {
            $total = 0;
            foreach ($turma->alunos as $key => $aluno)
            {
                if($aluno->user->gamificacao != null)
                {
                    $total += $aluno->user->gamificacao->sum('xp');
                }
                // $total += 1;
            }

            $turma->xp = $total;
        }

        $turmas = $turmas->sortByDesc('xp')->values();


        $userIndexGet = $usersXps->search(function ($user) {
            return $user->id === Auth::id();
        });

        ($userIndexGet !== false ? $userIndex = $userIndexGet + 1 : $userIndex = $userIndexGet);
        // $userIndex = $userIndexGet;

        $escolaUserIndexGet = $escolas->search(function ($escola) {
            return $escola->id === Auth::user()->escola_id;
        });

        ($escolaUserIndexGet !== false ? $escolaIndex = $escolaUserIndexGet + 1 : $escolaIndex = $escolaUserIndexGet);

        $turmaIndex = null;

        if(AlunoTurma::where('user_id', Auth::user()->id)->exists())
        {
            $turmaIndexGet = $turmas->search(function ($turma) {
                $turmaId = AlunoTurma::where('user_id', Auth::user()->id)->first();
                return $turma->id === $turmaId->turma_id;
            });

            ($turmaIndexGet !== false ? $turmaIndex = $turmaIndexGet + 1 : $turmaIndex = $turmaIndexGet);
        }

        // $userLogged = GamificacaoUsuario::where('user_id', Auth::id())->first();
        $userLogged = Auth::user()->with('gamificacao');

        if(AlunoTurma::where('user_id', Auth::user()->id)->exists())
        {
            $idUserTurma = AlunoTurma::where('user_id', Auth::user()->id)->first()->turma_id;
        }

        return view('pages.estatisticas.alunos.index', compact('aulas', 'habilidades', 'userIndex', 'userLogged', 'turmaIndex'));
    }

    private function getAulas($date, $turma)
    {
        $dayOfWeek = Carbon::createFromFormat('Y-m-d', $date)->dayOfWeek;
        if ($turma === "todas")
        {
            $turmasId = [];
            foreach (Auth::user()->turmas_aluno as $turma) {
                $turmasId[] = $turma->turma_id;
            }

            // Retorna as grades de aula relacionadas a todas as turmas que o aluno faz parte.
            return GradeAula::whereIn('turma_id', $turmasId)
                ->where(function ($query) use ($dayOfWeek, $date) {
                    $query->where([['recorrente', 0], ['data', $date]]);
                    $query->orWhere([['recorrente', 1], ['dia', $dayOfWeek]]);
                })->with('planos')->orderBy('hora_inicial')->get();
        }

        // Retorna as grades de aula relacionada a uma turma.
        return GradeAula::where('turma_id', $turma)->where(function ($query) use ($dayOfWeek, $date) {
            $query->where([['recorrente', 0], ['data', $date]]);
            $query->orWhere([['recorrente', 1], ['dia', $dayOfWeek]]);
        })->get();
    }
}
