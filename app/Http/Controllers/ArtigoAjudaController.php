<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\User;

use App\ArtigoAjuda;
use App\AvaliacaoArtigoAjuda;

class ArtigoAjudaController extends Controller
{
    public function index()
    {
        if(Input::get('qt') == null)
            $amount = 10;
        else
            $amount = Input::get('qt');

        if(Input::get('pesquisa') != null)
            $pesquisa = Input::get('pesquisa');

        if(isset($pesquisa))
        {
            $artigos = ArtigoAjuda::with('user')->where('id', 'like', '%' . $pesquisa . '%')->
                orWhere('titulo', 'like', '%' . $pesquisa . '%')->
                orWhere('conteudo', 'like', '%' . $pesquisa . '%')->
            paginate($amount);
        }
        else
        {
            $artigos = ArtigoAjuda::with('user');
        }

        $artigos = $artigos->where([['status', '=', 1]]);

        $artigos = $artigos->paginate($amount);

        return view('ajuda.artigos')->with( compact('artigos', 'amount') );
    }

    public function artigo($idArtigo)
    {
        if(ArtigoAjuda::find($idArtigo) != null)
        {
            $artigo = ArtigoAjuda::with('user', 'avaliacoes_user')->find($idArtigo);

            if($artigo->status != 1 && ((\Auth::user() ? \Auth::user()->permissao == "Z" : false) || (\Auth::user() ? \Auth::user()->id == $artigo->user_id : false)))
            {
                return redirect()->back()->withErrors("Artigo não encontrado!");
            }

            $artigo->marcadores = implode(";", json_decode($artigo->marcadores));
        }
        else
        {
            return redirect()->back()->withErrors("Artigo não encontrado!");
        }

        return view('ajuda.artigo')->with( compact('artigo') );
    }

    public function postAvaliarArtigo($idArtigo, Request $request)
    {
        // return response()->json(["error" => $request->all()]);

        if(Auth::check())
        {
            if(ArtigoAjuda::find($idArtigo) != null)
            {
                AvaliacaoArtigoAjuda::updateOrCreate([
                    'artigo_ajuda_id' => $idArtigo,
                    'user_id' => Auth::user()->id,
                ],
                [
                    'artigo_ajuda_id' => $idArtigo,
                    'user_id' => Auth::user()->id,
                    'avaliacao' => $request->avaliacao
                ]);

                return response()->json(["success" => "Artigo avaliado com sucesso!"]);
            }
            else
            {
                return response()->json(["success" => "Artigo não encontrado!"]);
            }
        }
        else
        {
            return response()->json(["error" => "Para avaliar um artigo você precisa estar logado!"]);
        }
    }

    public function postPesquisar(Request $request)
    {
        if($request->pesquisa != null)
        {
            $artigos = ArtigoAjuda::with('user')->where('id', 'like', '%' . $request->pesquisa . '%')
                ->orWhere('titulo', 'like', '%' . $request->pesquisa . '%')
                ->orWhere('conteudo', 'like', '%' . $request->pesquisa . '%')
                ->get();
        }
        else
        {
            $artigos = ArtigoAjuda::with('user')->all();
        }

        return response()->json(["success" => "Pesquisa concluída com sucesso!", "artigos" => $artigos]);

    }

    public function getAdmin()
    {
        if(Input::get('qt') == null)
            $amount = 10;
        else
            $amount = Input::get('qt');

        if(Input::get('pesquisa') != null)
            $pesquisa = Input::get('pesquisa');

        if(isset($pesquisa))
        {
            $artigos = ArtigoAjuda::with('user')->where('id', 'like', '%' . $pesquisa . '%')->
                orWhere('titulo', 'like', '%' . $pesquisa . '%')->
                orWhere('conteudo', 'like', '%' . $pesquisa . '%')->
            paginate($amount);
        }
        else
        {
            $artigos = ArtigoAjuda::with('user')->paginate($amount);

            foreach ($artigos as $key => $artigo)
            {
                $artigo->total_negativo = AvaliacaoArtigoAjuda::where('artigo_ajuda_id', $artigo->id)->where('avaliacao', -1)->count();
                $artigo->total_neutro = AvaliacaoArtigoAjuda::where('artigo_ajuda_id', $artigo->id)->where('avaliacao', 0)->count();
                $artigo->total_positivo = AvaliacaoArtigoAjuda::where('artigo_ajuda_id', $artigo->id)->where('avaliacao', 1)->count();
                $artigo->total_avaliacoes = AvaliacaoArtigoAjuda::where('artigo_ajuda_id', $artigo->id)->count();

                // dd($artigo);
            }
        }

        return view('gestao.ajuda.artigos')->with( compact('artigos', 'amount') );
    }

    public function postNovo(Request $request)
    {
        if($request->marcadores == null)
        {
            $request->marcadores = [];
        }
        else
        {
            $request->marcadores = explode(';', $request->marcadores);
        }

        // dd(gettype($request->marcadores));

        $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required',
            'categoria' => 'required',
        ]);

        ArtigoAjuda::create([
            'user_id' => Auth::user()->id,
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'categoria' => $request->categoria,
            'marcadores' => json_encode($request->marcadores, JSON_UNESCAPED_UNICODE),
            'status' => $request->status,
        ]);

        \Session::flash("success", "Artigo criado com sucesso!");

        return redirect()->back();
    }

    public function postAtualizar(Request $request)
    {
        if(ArtigoAjuda::find($request->id) != null)
        {
            $artigo = ArtigoAjuda::find($request->id);
        }
        else
        {
            return redirect()->back()->withErrors(["error" => 'Artigo não encontrado!']);
        }

        if($request->marcadores == null)
        {
            $request->marcadores = [];
        }
        else
        {
            $request->marcadores = explode(';', $request->marcadores);
        }

        $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required',
            'categoria' => 'required',
        ]);

        $artigo->update([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'categoria' => $request->categoria,
            'marcadores' => json_encode($request->marcadores, JSON_UNESCAPED_UNICODE),
            'status' => $request->status,
        ]);

        \Session::flash("success", "Artigo atualizado com sucesso!");

        return redirect()->back();
    }

    public function getArtigo($idArtigo)
    {
        if(ArtigoAjuda::find($idArtigo) != null)
        {
            $artigo = ArtigoAjuda::find($idArtigo);

            $artigo->marcadores = implode(";", json_decode($artigo->marcadores));

            $artigo->total_negativo = AvaliacaoArtigoAjuda::where('artigo_ajuda_id', $artigo->id)->where('avaliacao', -1)->count();
            $artigo->total_neutro = AvaliacaoArtigoAjuda::where('artigo_ajuda_id', $artigo->id)->where('avaliacao', 0)->count();
            $artigo->total_positivo = AvaliacaoArtigoAjuda::where('artigo_ajuda_id', $artigo->id)->where('avaliacao', 1)->count();
            $artigo->total_avaliacoes = AvaliacaoArtigoAjuda::where('artigo_ajuda_id', $artigo->id)->count();

            return response()->json(["success" => 'Artigo carregado com sucesso!', "artigo" => $artigo]);
        }
        else
        {
            return response()->json(["error" => 'Artigo não encontrado!']);
        }
    }

    public function getDeletarArtigo($idArtigo)
    {
        if(ArtigoAjuda::find($idArtigo) != null)
        {
            $artigo = ArtigoAjuda::find($idArtigo);

            AvaliacaoArtigoAjuda::where('artigo_ajuda_id', $artigo->id)->delete();

            $artigo->delete();

            return response()->json(["response" => true, "data" => 'Artigo deletado com sucesso!', "artigo" => $artigo, 200]);
        }
        else
        {
            return response()->json(["response" => false, "data" => 'Artigo não encontrado!', 404]);
        }
    }

}


