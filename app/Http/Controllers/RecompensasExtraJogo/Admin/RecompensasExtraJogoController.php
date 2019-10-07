<?php

namespace App\Http\Controllers\RecompensasExtraJogo\Admin;


use App\Entities\RecompensaExtraJogo\RecompensaExtraJogo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RecompensasExtraJogoController extends Controller
{

    public function index(Request $request)
    {
        $recompensasExtraJogo = RecompensaExtraJogo::orderBy('id', 'DESC')->paginate(6);

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;
        if($tem_pesquisa)
        {
            $recompensasExtraJogo = RecompensaExtraJogo::where('titulo', 'like', '%' . Input::get('pesquisa') . '%')->paginate(6);
        }

        return view('pages.recompensas-extra-jogo.admin.index', compact('recompensasExtraJogo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required'
        ]);
        $values = $request->all();
        $values['user_id'] = Auth::user()->id;

        RecompensaExtraJogo::create($values);
        return redirect()->route('gestao.recompensas-extra-jogo.listar')->with('message', 'Recompensa Extra-Jogo cadastrado com sucesso!');
    }

    public function fetch($id, Request $request)
    {
        $recompensaExtraJogo = RecompensaExtraJogo::find($id);

        return $recompensaExtraJogo->toJson();
    }       

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required'
        ]);
        $values = $request->all();
        RecompensaExtraJogo::find($id)->update($values);

        return redirect()->route('gestao.recompensas-extra-jogo.listar')->with('message', 'Recompensa Extra-Jogo atualizado com sucesso!');
    }


    public function delete($id)
    {
        RecompensaExtraJogo::find($id)->delete();

        return redirect()->route('gestao.recompensas-extra-jogo.listar')->with('message', 'Recompensa Extra-Jogo excluído com sucesso!');
    }

}
