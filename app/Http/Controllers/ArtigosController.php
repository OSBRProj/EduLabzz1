<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\Artigo;
use App\Categoria;

class ArtigosController extends Controller
{
    public function index ()
    {
        $artigos = Artigo::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $artigos->when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $is_admin = strtoupper(Auth::user()->permissao) == "Z";

        $artigos->when($is_admin == false, function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        });

        $artigos = $artigos
        ->where([['status', '=', 1]])
        ->orderBy('id', 'DESC')
        ->get();

        return view('artigos.index')->with( compact('artigos') );
    }

    public function gestaoArtigos()
    {
        $artigos = Artigo::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $artigos->when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $is_admin = strtoupper(Auth::user()->permissao) == "Z";

        $artigos->when($is_admin == false, function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        });

        $artigos = $artigos
        // ->where([['status', '=', 1]])
        ->orderBy('id', 'DESC')
        ->get();

        return view('gestao.artigos.index')->with( compact('artigos') );
    }

    public function lerArtigo($artigo_id, $sluged_title)
    {
        if(Artigo::find($artigo_id) != null)
        {
            $artigo = Artigo::find($artigo_id);

            return view('gestao.artigos.ler-artigo')->with( compact('artigo') );
        }
        else
        {
            return redirect("404");
            // return redirect()->route('gestao.artigos.index')->with('error', 'Artigo não encontrado!');
        }
    }

    public function create()
    {
        $categorias = Categoria::where([['tipo', '=', 4]])->get();

        return view('gestao.artigos.novo-artigo')->with( compact('categorias') );
    }

    public function store(Request $request)
    {
        // dd($request);

        if(isset($request->arquivo_capa))
        {
            $originalName = mb_strtolower( $request->arquivo_capa->getClientOriginalName(), 'utf-8' );

            $fileExtension = \File::extension($request->arquivo_capa->getClientOriginalName());
            $newFileNameArquivo =  md5( $request->arquivo_capa->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

            $pathArquivo = $request->arquivo_capa->storeAs('artigos', $newFileNameArquivo, 'public_uploads');

            if(!\Storage::disk('public_uploads')->put($pathArquivo, file_get_contents($request->arquivo_capa)))
            {
                // return redirect()->back()->with('error', 'Não foi possível fazer upload da capa, por favor tente novamente!');

                \Request::session()->flash('error', 'Não foi possível fazer upload da capa, por favor tente novamente!');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Você deve anexar uma capa para seu artigo!');
        }

        Artigo::create([
            'user_id' => \Auth::user()->id,
            'escola_id' => \Auth::user()->escola_id,
            'titulo' => $request->titulo,
            'subtitulo' => $request->subtitulo,
            'descricao' => $request->descricao,
            'conteudo' => $request->conteudo,
            'capa' => $newFileNameArquivo,
            'status' => $request->status == null ? 0 : $request->status,
        ]);

        // return redirect()->back()->with('message', 'Artigo criado com sucesso!');
        return redirect()->route('gestao.artigos.index')->with('message', 'Artigo criado com sucesso!');
    }

    public function update(Request $request)
    {
        // dd($request);

        if(Artigo::find($request->artigo_id) != null)
        {
            $artigo = Artigo::find($request->artigo_id);

            if(isset($request->arquivo_capa))
            {
                $originalName = mb_strtolower( $request->arquivo_capa->getClientOriginalName(), 'utf-8' );

                $fileExtension = \File::extension($request->arquivo_capa->getClientOriginalName());
                $newFileNameArquivo =  md5( $request->arquivo_capa->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

                $pathArquivo = $request->arquivo_capa->storeAs('artigos', $newFileNameArquivo, 'public_uploads');

                if(!\Storage::disk('public_uploads')->put($pathArquivo, file_get_contents($request->arquivo_capa)))
                {
                    \Session::flash('error', 'Não foi possível fazer upload de seu conteúdo!');
                }
                else
                {
                    if(\Storage::disk('public_uploads')->has('artigos/' . $artigo->capa))
                    {
                        \Storage::disk('public_uploads')->delete('artigos/' . $artigo->capa);
                    }

                    $artigo->update([
                        'capa' => $newFileNameArquivo,
                    ]);
                }
            }

            $artigo->update([
                'titulo' => $request->titulo,
                'subtitulo' => $request->subtitulo,
                'descricao' => $request->descricao,
                'conteudo' => $request->conteudo,
                'status' => $request->status
            ]);

            return redirect()->back()->with('message', 'Artigo atualizado com sucesso!');
        }
        else
        {
            return response()->json(["response" => false, "data" => "Artigo não encontrado!", 404]);
        }
    }

    public function editarArtigo($artigo_id)
    {
        if(Artigo::find($artigo_id) != null)
        {
            $artigo = Artigo::find($artigo_id);

            $categorias = Categoria::where([['tipo', '=', 4]])->get();

            return view('gestao.artigos.editar-artigo')->with( compact('artigo', 'categorias') );
        }
        else
        {
            return redirect()->route('gestao.artigos.index')->with('error', 'Artigo não encontrado!');
        }
    }

    public function getArtigo($artigo_id)
    {
        if(Artigo::find($artigo_id) != null)
        {
            $artigo = Artigo::find($artigo_id);

            return response()->json(["response" => true, "data" => "Artigo carregado com sucesso!", 'artigo' => $artigo ]);
        }
        else
        {
            return response()->json(["response" => false, "data" => "Artigo não encontrado!", 404]);
        }
    }

    public function delete(Request $request)
    {
        // dd($request);

        if(Artigo::find($request->artigo_id) != null)
        {
            $artigo = Artigo::find($request->artigo_id);

            if(\Storage::disk('public_uploads')->has('artigos/' . $artigo->capa))
            {
                \Storage::disk('public_uploads')->delete('artigos/' . $artigo->capa);
            }

            $artigo->delete();

            return response()->json(["response" => true, "data" => "Artigo excluído com sucesso!", 200]);
        }
        else
        {
            return response()->json(["response" => false, "data" => "Artigo não encontrado!", 404]);
        }
    }

}
