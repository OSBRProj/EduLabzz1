<?php

namespace App\Http\Controllers\Desafios\Admin;


use App\Entities\Desafio\Desafio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class DesafiosController extends Controller
{

    public function index(Request $request)
    {
        $desafios = Desafio::orderBy('id', 'DESC')->paginate(6);

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;
        if($tem_pesquisa)
        {
            $desafios = Desafio::where('titulo', 'like', '%' . Input::get('pesquisa') . '%')->paginate(6);
        }

        return view('pages.desafios.admin.index', compact('desafios'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required'
        ]);
        $values = $request->all();
        $values['user_id'] = Auth::user()->id;

        Desafio::create($values);
        return redirect()->route('gestao.desafios.listar')->with('message', 'Missão cadastrado com sucesso!');
    }

    public function fetch($id, Request $request)
    {
        $desafio = Desafio::find($id);

        return $desafio->toJson();
    }    

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required'
        ]);
        $values = $request->all();
        Desafio::find($id)->update($values);

        return redirect()->route('gestao.desafios.listar')->with('message', 'Desafio atualizado com sucesso!');
    }


    public function delete($id)
    {
        Desafio::find($id)->delete();

        return redirect()->route('gestao.desafios.listar')->with('message', 'Desafio excluído com sucesso!');
    }

}
