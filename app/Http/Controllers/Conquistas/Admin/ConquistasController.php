<?php

namespace App\Http\Controllers\Conquistas\Admin;


use App\Entities\Conquista\Conquista;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ConquistasController extends Controller
{

    public function index(Request $request)
    {
        $conquistas = Conquista::orderBy('id', 'DESC')->paginate(6);

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;
        if($tem_pesquisa)
        {
            $conquistas = Conquista::where('titulo', 'like', '%' . Input::get('pesquisa') . '%')->paginate(6);
        }

        return view('pages.conquistas.admin.index', compact('conquistas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required'
        ]);
        $values = $request->all();
        $values['user_id'] = Auth::user()->id;

        Conquista::create($values);
        return redirect()->route('gestao.conquistas.listar')->with('message', 'Conquista cadastrado com sucesso!');
    }

    public function fetch($id, Request $request)
    {
        $conquista = Conquista::find($id);

        return $conquista->toJson();
    }        

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required'
        ]);
        $values = $request->all();
        Conquista::find($id)->update($values);

        return redirect()->route('gestao.conquistas.listar')->with('message', 'Conquista atualizado com sucesso!');
    }


    public function delete($id)
    {
        Conquista::find($id)->delete();

        return redirect()->route('gestao.conquistas.listar')->with('message', 'Conquista excluído com sucesso!');
    }

}
