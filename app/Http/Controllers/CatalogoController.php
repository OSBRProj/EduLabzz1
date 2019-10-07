<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\Escola;
use App\Categoria;
use App\Curso;
use App\Aplicacao;
use App\Conteudo;
use App\AvaliacaoInstrutor;
use App\Matricula;
use App\Metrica;

class CatalogoController extends Controller
{
    public function index()
    {
        if(Input::get('qt') == null)
            $amount = 10;
        else
            $amount = Input::get('qt');

        if(Input::get('ordem') == null)
            $ordem = "recentes";
        else
            $ordem = Input::get('ordem');

        if(Input::get('categoria') == null)
            $categoria = "";
        elseif(Input::get('categoria') == "geral")
            $categoria = "";
        else
            $categoria = Input::get('categoria');

        if($categoria != null)
        {
            if(Categoria::where('titulo', '=', $categoria)->first() != null)
            {
                $categoria = Categoria::where('titulo', '=', $categoria)->first()->id;
            }
        }

        if(Input::get('pesquisa') == null || Input::get('pesquisa') == "")
        {
            $pesquisa = null;

            if($categoria != null)
            {
                $cursos = Curso::take($amount)->where([['status', '=', '1'], ['categoria', '=', $categoria]]);

                $aplicacoes = Aplicacao::take($amount)->where([['status', '=', '1'], ['categoria', '=', $categoria]]);
            }
            else
            {
                $cursos = Curso::take($amount)->where([['status', '=', '1']]);

                $aplicacoes = Aplicacao::take($amount)->where([['status', '=', '1']]);
            }
        }
        else
        {
            $cursos = Curso::take($amount)->where([['status', '=', '1'], ['titulo', 'like', '%' . Input::get('pesquisa') . '%']])
            ->orWhere([['status', '=', '1'], ['descricao', 'like', '%' . Input::get('pesquisa') . '%']]);

            $aplicacoes = Aplicacao::take($amount)->where([['status', '=', '1'], ['titulo', 'like', '%' . Input::get('pesquisa') . '%']])
            ->orWhere([['status', '=', '1'], ['descricao', 'like', '%' . Input::get('pesquisa') . '%']]);
        }

        // $aplicacoes = $aplicacoes->orderBy('data_publicacao', 'desc');

        if($ordem == 'recentes')
        {
            $cursos = $cursos->orderBy('created_at', 'desc');

            $aplicacoes = $aplicacoes->orderBy('created_at', 'desc');

            $ordem = "Mais recentes";
        }
        elseif($ordem == 'antigos')
        {
            $cursos = $cursos->orderBy('created_at', 'asc');

            $aplicacoes = $aplicacoes->orderBy('created_at', 'asc');

            $ordem = "Mais antigos";
        }
        elseif($ordem == 'alfabetica')
        {
            $cursos = $cursos->orderBy('titulo', 'asc');

            $aplicacoes = $aplicacoes->orderBy('titulo', 'asc');

            $ordem = "Ordem Alfabética";
        }

        $cursos = $cursos->get();

        $aplicacoes = $aplicacoes->get();

        $categorias = Categoria::take(8)->get();

        $destaques = $aplicacoes->take(3);

        return view('catalogo')->with( compact('cursos', 'aplicacoes', 'pesquisa', 'amount', 'ordem', 'categorias', 'destaques') );
    }
}
