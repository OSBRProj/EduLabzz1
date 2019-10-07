<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\User;
use App\Aplicacao;
use App\LiberacaoAplicacaoUser;
use App\LiberacaoAplicacaoEscola;
use App\AlunoTurma;
use App\Turma;

class LiberacaoController extends Controller
{

    public function postLiberarAplicacaoEscola(Request $request)
    {
        if($request->tipo_liberacao == 2)
        {
            $request->validate([
                'escola_id' => 'required|exists:escolas,id',
            ]);

            foreach (Aplicacao::where('colecao_id', '=', $request->colecao_id)->get() as $key => $aplicacao)
            {
                if(LiberacaoAplicacaoEscola::where([['escola_id', '=', $request->escola_id], ['aplicacao_id', '=', $aplicacao->id]])->exists() == false)
                {
                    LiberacaoAplicacaoEscola::create([
                        'aplicacao_id' => $aplicacao->id,
                        'escola_id' => $request->escola_id,
                    ]);
                }
            }

            Session::flash("message", 'Coleção liberada com sucesso!');
        }
        else
        {
            $request->validate([
                'aplicacao_id' => 'required|exists:aplicacoes,id',
                'escola_id' => 'required|exists:escolas,id',
            ]);

            if(LiberacaoAplicacaoEscola::where([['escola_id', '=', $request->escola_id], ['aplicacao_id', '=', $request->aplicacao_id]])->exists() == false)
            {
                LiberacaoAplicacaoEscola::create([
                    'aplicacao_id' => $request->aplicacao_id,
                    'escola_id' => $request->escola_id,
                ]);
            }

            Session::flash("message", 'Aplicação liberada com sucesso!');
        }

        return redirect()->back();
    }

    // public function postExcluirLiberarAplicacaoEscola($idAplicacao, $idEscola)
    // {
    //     if(LiberacaoAplicacaoEscola::where([['aplicacao_id', $idAplicacao], ['escola_id', $idEscola]])->exists())
    //     {
    //         LiberacaoAplicacaoEscola::where([['aplicacao_id', $idAplicacao], ['escola_id', $idEscola]])->delete();

    //         return response()->json(["success" => "Liberação excluída com sucesso!"]);
    //     }
    //     else
    //     {
    //         return response()->json(["error" => "Liberação não encontrada!"]);
    //     }
    // }

    public function postExcluirLiberarAplicacaoEscola($idLiberacao)
    {
        if(LiberacaoAplicacaoEscola::find($idLiberacao) != null)
        {
            LiberacaoAplicacaoEscola::find($idLiberacao)->delete();

            return response()->json(["success" => "Liberação excluída com sucesso!"]);
        }
        else
        {
            return response()->json(["error" => "Liberação não encontrada!"]);
        }
    }

    public function postLiberacaoAplicacaoUser($idTurma, Request $request)
    {
        if(Turma::find($idTurma) != null)
        {
            if(Aplicacao::find($request->idAplicacao) != null)
            {
                $alunos = json_decode($request->alunos);

                if($alunos == null)
                {
                    // return redirect()->back()->withErrors("Você deve selecionar ao menos um aluno!");
                    $alunos = [];
                }
                // if(count($alunos) == 0)
                // {
                //     return redirect()->back()->withErrors("Você deve selecionar ao menos um aluno!");
                // }

                if($request->quais == "nenhum")
                {
                    LiberacaoAplicacaoUser::where([['aplicacao_id', '=', $request->idAplicacao]])->whereNotIn('user_id', $alunos)->delete();

                    foreach($alunos as $aluno)
                    {
                        if(!LiberacaoAplicacaoUser::where([['aplicacao_id', '=', $request->idAplicacao], ['user_id', '=', $aluno]])->exists())
                        {
                            LiberacaoAplicacaoUser::create([
                                'aplicacao_id' => $request->idAplicacao,
                                'user_id' => $aluno
                            ]);
                        }
                    }
                }
                else
                {
                    LiberacaoAplicacaoUser::where([['aplicacao_id', '=', $request->idAplicacao]])->whereIn('user_id', $alunos)->delete();

                    foreach(AlunoTurma::where([['turma_id', '=', $idTurma]])->whereNotIn('user_id', $alunos)->get() as $aluno)
                    {
                        if(!LiberacaoAplicacaoUser::where([['aplicacao_id', '=', $request->idAplicacao], ['user_id', '=', $aluno->user_id]])->exists())
                        {
                            LiberacaoAplicacaoUser::create([
                                'aplicacao_id' => $request->idAplicacao,
                                'user_id' => $aluno->user_id
                            ]);
                        }
                    }
                }

                Session::flash("message", 'Aplicação liberada com sucesso para ' . count($alunos) . ' aluno' . (count($alunos) != 1 ? 's' : '' ) . '!');
                return redirect()->back();

            }
            else
            {
                return redirect()->back()->withErrors("Aplicação não encontrada!");
            }
        }
        else
        {
            return redirect()->back()->withErrors("Turma não encontrada!");
        }
    }
}
