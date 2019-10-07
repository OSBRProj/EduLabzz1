<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\User;
use App\CodigoAcessoEscola;
use App\Escola;
use App\Turma;

class CodigoAcessoEscolaController extends Controller
{
    public function index()
    {
        $escola = Escola::find(Auth::user()->escola_id);

        if($escola == null)
        {
            return redirect()->back()->withErrors("Escola não encontrada!");
        }

        $codigosAcesso = CodigoAcessoEscola::where('escola_id', $escola->id)->get();

        $turmas = Turma::whereHas('professor', function($q) use ($escola) {
            $q->where('escola_id', '=', $escola->id);
        })->get();

        $alunos = User::where([['escola_id', $escola->id], ['permissao', "A"]])->get();

        return view('gestao.escola.codigos')->with(compact( 'codigosAcesso', 'turmas', 'escola', 'alunos' ));
    }

    public function postGerarCodigosAcesso($idEscola, Request $request)
    {
        if(Escola::find($idEscola) != null)
        {
            $escola = Escola::find($idEscola);

            if(strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "Z") !== false
                && Auth::user()->id != $escola->user_id //Checa se é dono da escola
                && Auth::user()->escola_id != $escola->id) //Checa se faz parte da escola
            {
                return redirect()->back()->withErrors("Você não tem permissão para realizar esta ação!");
            }

            if($request->turma_id != null ? (Turma::find($request->turma_id) == null) : false)
            {
                return redirect()->back()->withErrors("Turma não encontrada!");
            }

            if($request->quantidade <= 0)
            {
                return redirect()->back()->withErrors("Você deve gerar 1 ou mais códigos!");
            }

            if(($escola->limite_alunos - User::where([['escola_id', $idEscola], ['permissao', 'A']])->count()) <= 0)
            {
                return redirect()->back()->withErrors("Você não pode gerar mais códigos!");
            }

            if($request->quantidade > ($escola->limite_alunos - User::where([['escola_id', $idEscola], ['permissao', 'A']])->count() - CodigoAcessoEscola::where([['escola_id', $escola->id], ['aluno_id', null]])->count()))
            {
                return redirect()->back()->withErrors("Você não pode gerar mais códigos que seu limite de alunos!");
            }

            if($request->quantidade > 250)
            {
                return redirect()->back()->withErrors("Por favor tente gerar uma menor quantidade de códigos, e se precisar de mais gere novamente.");
            }

            $count = 0;

            for ($i = 0; $i < $request->quantidade; $i++)
            {
                $token = self::getTokenRandomico();

                if($token == null)
                {
                    continue;
                }

                CodigoAcessoEscola::create([
                    'escola_id' => $idEscola,
                    'turma_id' => $request->turma_id,
                    'codigo' => mb_strtoupper($token, 'UTF-8')
                ]);

                $count ++;
            }

            Session::flash("message", 'Códigos de acesso gerados com sucesso, agora basta passar aos seus alunos. (' . $count . ' códigos gerados)');
            return redirect()->back();
        }
        else
        {
            return redirect()->back()->withErrors("Escola não encontrada!");
        }
    }

    public function postExcluirCodigoAcesso($idEscola, $idCodigo)
    {
        $escola = Escola::find($idEscola);

        if(Escola::find($idEscola) == null)
        {
            return redirect()->back()->withErrors("Escola não encontrada!");
        }

        if(strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "Z") !== false
            && Auth::user()->id != $escola->user_id //Checa se é dono da escola
            && Auth::user()->escola_id != $escola->id) //Checa se faz parte da escola
        {
            return redirect()->back()->withErrors("Você não tem permissão para realizar esta ação!");
        }

        if(CodigoAcessoEscola::find($idCodigo) != null)
        {
            CodigoAcessoEscola::find($idCodigo)->delete();

            return response()->json(["success" => "Código de acesso excluido com sucesso!"]);
        }
        else
        {
            return response()->json(["error" => "Código de acesso não encontrada!"]);
        }
    }

    public function getTokenRandomico()
    {
        $step = 0;

        do
        {
            if($step < 10)
            {
                $token = \HelperClass::RandomString(4);
            }
            else if($step < 20)
            {
                $token = \HelperClass::RandomString(6);
            }
            else if($step < 30)
            {
                $token = \HelperClass::RandomString(10);
            }
            else if($step < 40)
            {
                $token = \HelperClass::RandomString(12);
            }
            else
            {
                $token = \HelperClass::RandomString(15);
            }

            $step ++;

        } while(CodigoAcessoEscola::where('codigo', '=', $token)->exists() && $step < 50);

        if($step >= 50)
        {
            return null;
        }
        else
        {
            return $token;
        }
    }

}
