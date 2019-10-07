<?php

namespace App\Http\Controllers\Missoes\Admin;


use App\Entities\Missao\Missao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class MissoesController extends Controller
{

    public function index(Request $request)
    {
        $missoes = Missao::orderBy('id', 'DESC')->paginate(6);

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;
        if($tem_pesquisa)
        {
            $missoes = Missao::where('titulo', 'like', '%' . Input::get('pesquisa') . '%')->paginate(6);
        }

        return view('pages.missoes.admin.index', compact('missoes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required'
        ]);
        $values = $request->all();
        $values['user_id'] = Auth::user()->id;

        Missao::create($values);
        return redirect()->route('gestao.missoes.listar')->with('message', 'Missão cadastrada com sucesso!');
    }

    public function fetch($id, Request $request)
    {
        $missao = Missao::find($id);

        return $missao->toJson();
    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required'
        ]);
        $values = $request->all();
        Missao::find($id)->update($values);

        return redirect()->route('gestao.missoes.listar')->with('message', 'Missão atualizada com sucesso!');
    }


    public function delete($id)
    {
        Missao::find($id)->delete();

        return redirect()->route('gestao.missoes.listar')->with('message', 'Missão excluída com sucesso!');
    }

}
