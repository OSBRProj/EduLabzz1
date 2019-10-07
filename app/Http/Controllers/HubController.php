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

use App\Aplicacao;
use App\Conteudo;
use App\AvaliacaoInstrutor;
use App\Matricula;
use App\Metrica;

class HubController extends Controller
{
    public function index()
    {
        if(Input::get('qt') == null)
            $amount = 9;
        else
            $amount = Input::get('qt');

        if(Input::get('ordem') == null)
            $ordem = "alfabetica"; //"recentes"
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
                $aplicacoes = Aplicacao::with('categoria')->take($amount)->where(function ($query) {
                $query->where('data_lancamento', '=', null)->orWhere('data_lancamento', '<=', date('Y-m-d H:i:s'));
            })->where([['status', '=', '1'], ['categoria_id', '=', $categoria]]);

                $aplicacoes = $aplicacoes->orWhere([['status', '=', '1'], ['tags', 'like', '%' . Categoria::find($categoria)->titulo . '%']]);
            }
            elseif(Input::get('marcador') != null && Input::get('marcador') != "")
            {
                $aplicacoes = Aplicacao::with('categoria')->take($amount)->where(function ($query) {
                $query->where('data_lancamento', '=', null)->orWhere('data_lancamento', '<=', date('Y-m-d H:i:s'));
            })->where([['status', '=', '1'], ['categoria_id', '=', $categoria]]);

                $aplicacoes = $aplicacoes->orWhere([['status', '=', '1'], ['tags', 'like', '%' . Input::get('marcador') . '%']]);
            }
            else
            {
                $aplicacoes = Aplicacao::with('categoria')->take($amount)->where(function ($query) {
                $query->where('data_lancamento', '=', null)->orWhere('data_lancamento', '<=', date('Y-m-d H:i:s'));
            })->where([['status', '=', '1']]);
            }
        }
        else
        {
            $aplicacoes = Aplicacao::with('categoria')->take($amount)->where([['status', '=', '1'], ['titulo', 'like', '%' . Input::get('pesquisa') . '%']])
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        }

        // $aplicacoes = $aplicacoes->orderBy('data_publicacao', 'desc');

        if($ordem == 'recentes')
        {
            $aplicacoes = $aplicacoes->orderBy('created_at', 'desc');
            $ordem = "Mais recentes";
        }
        elseif($ordem == 'antigos')
        {
            $aplicacoes = $aplicacoes->orderBy('created_at', 'asc');
            $ordem = "Mais antigos";
        }
        elseif($ordem == 'alfabetica')
        {
            $aplicacoes = $aplicacoes->orderBy('titulo', 'asc');
            $ordem = "Ordem Alfabética";
        }

        $destaques = $aplicacoes;

        $aplicacoes = $aplicacoes->paginate($amount);

        $destaques = $destaques->where('destaque', '=', 1)->take(5)->get();

        // Preencher destaques se menos que o minimo para o carrousel
        // if(count($destaques) < 5)
        // {
        //     $maisDestaques = $aplicacoes->take(5 - count($destaques));
        //     $destaques = $destaques->merge($maisDestaques);
        // }

        $categorias = Categoria::where([['tipo', '=', 3]])->take(12)->orderBy('titulo', 'asc')->get();

        $marcadores = [];

        foreach ($aplicacoes as $aplicacao)
        {
            if($aplicacao->capa == "")
            {
                $aplicacao->capa = str_replace(".swf", ".png", $aplicacao->arquivo);
                // $aplicacao->capa = 'image' . $aplicacao->id . '.png';
            }
        }

        foreach (Aplicacao::groupBy('tags')->pluck('tags') as $tags)
        {
            if($tags != null)
            {
                foreach ($tags as $tag)
                {
                    if(!in_array($tag, $marcadores) && !$categorias->contains('titulo', $tag))
                    {
                        array_push($marcadores, $tag);
                    }
                }
            }
        }

        // dd($marcadores);



        return view('hub.index')->with( compact('aplicacoes', 'pesquisa', 'amount', 'ordem', 'categorias', 'marcadores', 'destaques') );
    }

    public function aplicacao($idAplicacao)
    {
        $aplicacao = Aplicacao::with('categoria')->find($idAplicacao);

        if($aplicacao == null)
        {
            \Session::flash('warning', 'Aplicação não encontrada.');
            return redirect()->route('hub.index');
        }

        if(!\Storage::disk('public_uploads')->has('aplicacoes/' . $aplicacao->id) || ($aplicacao->status == 0 && Auth::user()->permissao != "Z"))
        {
            \Session::flash('warning', 'Aplicação não encontrada.');

            return redirect()->route('hub.index');
        }

        Metrica::create([
            'user_id' => Auth::check() ? Auth::user()->id : 0,
            'titulo' => 'Visualizar aplicação - ' . $aplicacao->id
        ]);

        $relacionados = Aplicacao::where([['id', '!=', $aplicacao->id], ['categoria_id', '=', $aplicacao->categoria_id]])->get();

        return view('hub.aplicacao')->with( compact('aplicacao', 'relacionados') );
    }

    public function playAplicacao($idAplicacao)
    {
        $aplicacao = Aplicacao::find($idAplicacao);

        if($aplicacao == null)
        {
            \Session::flash('warning', 'Aplicação não encontrada.');
            return redirect()->route('hub.index');
        }

        if(!\Storage::disk('public_uploads')->has('aplicacoes/' . $aplicacao->id) || ($aplicacao->status == 0 && Auth::user()->permissao != "Z"))
        {
            \Session::flash('warning', 'Aplicação não encontrada.');

            return redirect()->route('hub.index');
        }

        Metrica::create([
            'user_id' => Auth::check() ? Auth::user()->id : 0,
            'titulo' => 'Jogar aplicação - ' . $aplicacao->id
        ]);

        return view('hub.aplicacao-play')->with( compact('aplicacao') );
    }

    public function ultimaAplicacao()
    {
        if(Metrica::where([['user_id', '=', Auth::user()->id], ['titulo', 'like', 'Jogar aplicação%']])->first() != null)
        {
            $idUltimaAplicacao = str_replace('Jogar aplicação - ', "", Metrica::where([['user_id', '=', Auth::user()->id], ['titulo', 'like', 'Jogar aplicação - %']])->first()->titulo);

            return redirect()->route('aplicacao', ['idAplicacao' => $idUltimaAplicacao]);
        }
        else
        {
            \Session::flash('error', 'Você não acessou nenhum aplicação recentemente.');

            return redirect()->route('hub.index');
        }
    }
}
