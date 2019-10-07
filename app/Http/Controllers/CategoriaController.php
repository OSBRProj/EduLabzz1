<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Redirect;
use Session;

use App\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        return 'base';
    }

    public function categorias()
    {

        if(Input::get('qt') == null)
            $amount = 10;
        else
            $amount = Input::get('qt');


        if(Input::get('pesquisa') != null)
            $pesquisa = Input::get('pesquisa');

        if(isset($pesquisa))
        {
            $categorias = Categoria::where('id', 'like', '%' . $pesquisa . '%')->
                orWhere('titulo', 'like', '%' . $pesquisa . '%')->
                paginate($amount);
        }
        else
        {
            $categorias = Categoria::paginate($amount);
        }

        // dd($categorias);

        return view('dashboard.categorias')->with(compact('categorias', 'amount'));

    }

    public function postNova(Request $request)
    {

        // dd(Categoria::where('titulo', '=', $request->titulo)->first());

        if(Categoria::where('titulo', '=', $request->titulo)->first() != null)
        {
            \Session::flash('error', '!Categoria já existente!');
        }
        else
        {
            Categoria::create([
                'user_id' => \Auth::user()->id,
                'titulo' => mb_strtolower($request->titulo, 'utf-8'),
                'tipo' => $request->tipo,
            ]);

            \Session::flash('success', 'Categoria criada com sucesso!');
        }

        return redirect()->route('gestao.categorias');

    }

    public function postUpdate(Request $request)
    {

        if(Categoria::find($request->id) != null)
        {
            Categoria::find($request->id)->update([
                'titulo' => mb_strtolower($request->titulo, 'utf-8'),
                'tipo' => $request->tipo,
            ]);

            return Redirect::back()->with('message', 'Categoria atualizada com sucesso!');
        }
        else
        {
            return Redirect::back()->withErrors(['Categoria não encontrada!']);
        }

    }

    public function getCategoria($idCategoria)
    {
        if(Categoria::find($idCategoria) != null)
        {
            $categoria = Categoria::find($idCategoria);

            return response()->json(["response" => true, 'data' => 'Categoria encontrada com sucesso!', 'categoria' => $categoria]);
        }
        else
        {
            return response()->json(["response" => false, 'data' => 'Categoria não encontrada!']);
        }

    }

    public function deletar($idCategoria)
    {
        if( strrpos(mb_strtoupper(\Auth::user()->permissao, 'UTF-8'), "Z") === false)
        {
            return response()->json(['error' => 'Você não tem permissão para deletar este item, consulte o administrador!']);
        }

        if(Categoria::find($idCategoria) != null)
        {
            if(mb_strtolower(Categoria::find($idCategoria)->titulo, 'utf-8') != "geral")
            {
                $categoria = Categoria::find($idCategoria);

                $categoria->delete();

                return response()->json(['success' => 'Categoria deletada com sucesso!']);
            }
            else
            {
                return response()->json(['error' => 'Você não pode deletar a categorial Geral!']);
            }
        }
        else
        {
            return response()->json(['error' => 'Categoria não encontrada!']);
        }

    }
}
