<?php

namespace App\Http\Controllers\RecompensasVirtuais\Admin;


use App\Entities\RecompensaVirtual\RecompensaVirtual;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RecompensasVirtuaisController extends Controller
{

    public function index(Request $request)
    {
        $recompensasVirtuais = RecompensaVirtual::orderBy('id', 'DESC')->paginate(6);

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;
        if($tem_pesquisa)
        {
            $recompensasVirtuais = RecompensaVirtual::where('titulo', 'like', '%' . Input::get('pesquisa') . '%')->paginate(6);
        }

        return view('pages.recompensas-virtuais.admin.index', compact('recompensasVirtuais'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required'
        ]);
        $values = $request->all();
        $values['user_id'] = Auth::user()->id;

        RecompensaVirtual::create($values);
        return redirect()->route('gestao.recompensas-virtuais.listar')->with('message', 'Recompensa Virtual cadastrado com sucesso!');
    }

    public function fetch($id, Request $request)
    {
        $recompensaVirtual = RecompensaVirtual::find($id);

        return $recompensaVirtual->toJson();
    }       

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required'
        ]);
        $values = $request->all();
        RecompensaVirtual::find($id)->update($values);

        return redirect()->route('gestao.recompensas-virtuais.listar')->with('message', 'Recompensa Virtual atualizado com sucesso!');
    }


    public function delete($id)
    {
        RecompensaVirtual::find($id)->delete();

        return redirect()->route('gestao.recompensas-virtuais.listar')->with('message', 'Recompensa Virtual excluído com sucesso!');
    }

}
