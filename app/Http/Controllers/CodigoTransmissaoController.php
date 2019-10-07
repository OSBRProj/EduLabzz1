<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\User;
use App\Conteudo;
use App\Aplicacao;
use App\CodigoTransmissao;
use App\Turma;

class CodigoTransmissaoController extends Controller
{
    public function index(Request $request)
    {
        $transmissao = CodigoTransmissao::where([['id', '=', $request->codigo], ['status', '=', 1]])->orWhere([['token', '=', $request->codigo], ['status', '=', 1]])->first();

        if($transmissao == null)
        {
            return Redirect::back()->withErrors(['Transmissão não encontrada!']);
        }
        else
        {
            // Aplicacao
            if($transmissao->tipo == 1)
            {
                if(Aplicacao::find($transmissao->referencia_id) != null)
                {
                    return redirect()->route('aplicacao', ['idAplicacao' => $transmissao->referencia_id]);
                }
                else
                {
                    return Redirect::back()->withErrors(['Aplicação não encontrada!']);
                }
            }
            // Conteudo
            else if($transmissao->tipo == 2)
            {
                if(Conteudo::find($transmissao->referencia_id) != null)
                {
                    return redirect()->route('conteudo.play', ['idConteudo' => $transmissao->referencia_id]);
                }
                else
                {
                    return Redirect::back()->withErrors(['Conteúdo não encontrado!']);
                }
            }
            else
            {
                return Redirect::back()->withErrors(['Transmissão não encontrada!']);
            }
        }

        return Redirect::back()->withErrors(['Transmissão não encontrada!']);
    }

    public function token($token)
    {
        $transmissao = CodigoTransmissao::where([['id', '=', $token], ['status', '=', 1]])->orWhere([['token', '=', $token], ['status', '=', 1]])->first();

        if($transmissao == null)
        {
            return Redirect::back()->withErrors(['Transmissão não encontrada!']);
        }
        else
        {
            // Aplicacao
            if($transmissao->tipo == 1)
            {
                if(Aplicacao::find($transmissao->referencia_id) != null)
                {
                    return redirect()->route('aplicacao', ['idAplicacao' => $transmissao->referencia_id]);
                }
                else
                {
                    return Redirect::back()->withErrors(['Aplicação não encontrada!']);
                }
            }
            // Conteudo
            else if($transmissao->tipo == 2)
            {
                if(Conteudo::find($transmissao->referencia_id) != null)
                {
                    return redirect()->route('conteudo.play', ['idConteudo' => $transmissao->referencia_id]);
                }
                else
                {
                    return Redirect::back()->withErrors(['Conteúdo não encontrado!']);
                }
            }
            else
            {
                return Redirect::back()->withErrors(['Transmissão não encontrada!']);
            }
        }

        return Redirect::back()->withErrors(['Transmissão não encontrada!']);
    }

    public function postNovoCodigoTransmissao($idTurma, Request $request)
    {
        if(Turma::find($idTurma) != null)
        {
            if($request->tipo == 1)
            {
                if(Aplicacao::find($request->idAplicacao) != null)
                {
                    CodigoTransmissao::create([
                        'user_id' => Auth::user()->id,
                        'token' => $request->codigo,
                        'referencia_id' => $request->idAplicacao,
                        'tipo' => $request->tipo,
                    ]);

                    Session::flash("message", 'Código de transmissão criado com sucesso! Agora é só usar o código: ' . $request->codigo . ' para acessar sua aplicação.');
                    return redirect()->back();
                }
                else
                {
                    return redirect()->back()->withErrors("Aplicação não encontrada!");
                }
            }
            else
            {
                if(Conteudo::find($request->idConteudo) != null)
                {
                    CodigoTransmissao::create([
                        'user_id' => Auth::user()->id,
                        'token' => $request->codigo,
                        'referencia_id' => $request->idConteudo,
                        'tipo' => $request->tipo,
                    ]);

                    Session::flash("message", 'Código de transmissão criado com sucesso! Agora é só usar o código: ' . $request->codigo . ' para acessar seu conteúdo.');
                    return redirect()->back();
                }
                else
                {
                    return redirect()->back()->withErrors("Conteúdo não encontrado!");
                }
            }
        }
        else
        {
            return redirect()->back()->withErrors("Turma não encontrada!");
        }
    }

    public function postExcluirCodigoTransmissao($idTransmissao)
    {
        if(CodigoTransmissao::find($idTransmissao) != null)
        {
            CodigoTransmissao::find($idTransmissao)->delete();

            return response()->json(["success" => "Transmissão encerrada com sucesso!"]);
        }
        else
        {
            return response()->json(["error" => "Transmissão não encontrada!"]);
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

        } while(CodigoTransmissao::where('token', '=', $token)->exists() && $step < 50);

        if($step >= 50)
        {
            return response()->json(['error' => 'Não foi possível gerar um token aleatório, por favor tente novamente.', 'step' => $step]);
        }
        else
        {
            return response()->json(['success' => 'Token aleatório gerado com sucesso!', 'step' => $step, 'token' => $token]);
        }
    }

}
