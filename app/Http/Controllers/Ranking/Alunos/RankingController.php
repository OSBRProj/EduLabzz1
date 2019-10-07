<?php

namespace App\Http\Controllers\Ranking\Alunos;

use App\AlunoTurma;
use App\Entities\GamificacaoUsuario\GamificacaoUsuario;
use App\Escola;
use App\Turma;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{

    public function index()
    {
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

        $idUserTurma = null;

        if(AlunoTurma::where('user_id', Auth::user()->id)->exists())
        {
            $idUserTurma = AlunoTurma::where('user_id', Auth::user()->id)->first()->turma_id;
        }


        return view('pages.ranking.alunos.index', compact('usersXps', 'userIndex', 'turmaIndex', 'idUserTurma', 'userLogged', 'escolas', 'turmas', 'escolaIndex'));
    }

}
