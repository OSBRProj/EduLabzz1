<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\User;
use App\Conteudo;
use App\Metrica;
use App\Turma;
use App\AlunoTurma;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function home()
    {
        if(Metrica::where([['user_id', '=', Auth::user()->id], ['titulo', 'like', 'Jogar aplicação%']])->first() != null)
        {
            $idUltimaAplicacao = str_replace('Jogar aplicação - ', "", Metrica::where([['user_id', '=', Auth::user()->id], ['titulo', 'like', 'Jogar aplicação - %']])->first()->titulo);
        }
        else
        {
            $idUltimaAplicacao = 0;
        }

        if(AlunoTurma::where('user_id', '=', Auth::user()->id)->first() != null)
        {
            $idTurma = AlunoTurma::where('user_id', '=', Auth::user()->id)->first()->turma_id;
        }
        else
        {
            $idTurma = 0;
        }

        if(Turma::find($idTurma) != null)
        {
            $idProfessor = Turma::find($idTurma)->user_id;
        }
        else
        {
            $idProfessor = 0;
        }

        return view('home')->with( compact('idUltimaAplicacao', 'idTurma', 'idProfessor') );
    }

    public function entrar()
    {
        if(\Auth::check())
        {
            return redirect()->route('catalogo');
        }
        else
        {
            return view('auth.login');
        }
    }

    public function registrar()
    {
        if(\Auth::check())
        {
            return redirect()->route('catalogo');
        }
        else
        {
            return view('auth.register');
        }

    }
}
