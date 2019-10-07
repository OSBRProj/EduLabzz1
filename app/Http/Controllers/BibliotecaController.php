<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\Escola;
use App\Categoria;
use App\Conteudo;
use App\Aplicacao;
use App\AvaliacaoConteudo;
use App\AvaliacaoInstrutor;
use App\Metrica;

class BibliotecaController extends Controller
{
    public function index()
    {
        if(Input::get('qt') == null)
            $amount = 100;
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

        // Carregar aplicacoes

        if(Input::get('pesquisa') == null || Input::get('pesquisa') == "")
        {
            $pesquisa = null;

            if($categoria != null)
                $aplicacoes = Aplicacao::take($amount)->where([['status', '=', '1'], ['categoria', '=', $categoria]]);
            else
                $aplicacoes = Aplicacao::take($amount)->where([['status', '=', '1']]);

            if($categoria != null)
                $conteudos = Conteudo::take($amount)->where([['status', '=', '1'], ['categoria', '=', $categoria]]);
            else
                $conteudos = Conteudo::take($amount)->where([['status', '=', '1']]);
        }
        else
        {
            $aplicacoes = Aplicacao::take($amount)->where([['status', '=', '1'], ['titulo', 'like', '%' . Input::get('pesquisa') . '%']])
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');

            $conteudos = Conteudo::take($amount)->where([['status', '=', '1'], ['titulo', 'like', '%' . Input::get('pesquisa') . '%']])
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        }

        if($ordem == 'recentes')
        {
            $aplicacoes = $aplicacoes->orderBy('created_at', 'desc');

            $conteudos = $conteudos->orderBy('created_at', 'desc');

            $ordem = "Mais recentes";
        }
        elseif($ordem == 'antigos')
        {
            $aplicacoes = $aplicacoes->orderBy('created_at', 'asc');

            $conteudos = $conteudos->orderBy('created_at', 'asc');

            $ordem = "Mais antigos";
        }
        elseif($ordem == 'alfabetica')
        {
            $aplicacoes = $aplicacoes->orderBy('titulo', 'asc');

            $conteudos = $conteudos->orderBy('titulo', 'asc');

            $ordem = "Ordem Alfabética";
        }

        $aplicacoes = $aplicacoes->get();

        $conteudos = $conteudos->get();

        $categorias = Categoria::take(8)->get();

        $videos = $conteudos->filter(function ($c) {
            return $c->tipo == 3;
        });

        $slides = $conteudos->filter(function ($c) {
            return ($c->tipo == 4 && (strpos($c->conteudo, ".ppt") !== false || strpos($c->conteudo, ".pptx") !== false));
        });

        $documentos = $conteudos->filter(function ($c) {
            return $c->tipo == 1 || ($c->tipo == 4 && (strpos($c->conteudo, ".ppt") == false && strpos($c->conteudo, ".pptx") == false));
        });

        $apostilas = $conteudos->filter(function ($c) {
            return $c->tipo == 11;
        });

        return view('biblioteca')->with( compact('conteudos', 'videos', 'slides', 'apostilas', 'documentos', 'aplicacoes', 'amount', 'ordem', 'categorias') );
    }

}
