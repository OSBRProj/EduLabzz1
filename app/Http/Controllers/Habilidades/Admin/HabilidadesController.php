<?php

namespace App\Http\Controllers\Habilidades\Admin;


use App\Entities\Habilidade\Habilidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HabilidadesController extends Controller
{
    private $habilidade;

    public function __construct(Habilidade $habilidade)
    {
        $this->habilidade = $habilidade;
    }

    public function index()
    {

        $habilidades = Habilidade::orderBy('id', 'DESC')->get();
        $categorias = Habilidade::all()->pluck('categoria')->unique()->toArray();
        return view('pages.habilidades.admin.index', compact('habilidades', 'categorias'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required',
            'categoria' => 'required'
        ]);
        $values = $request->all();
        $values['user_id'] = Auth::user()->id;

        Habilidade::create($values);
        return redirect()->route('gestao.habilidades.listar')->with('message', 'Habilidade cadastrada com sucesso!');
    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
            'titulo'    => 'required',
            'categoria' => 'required'
        ]);
        $values = $request->all();
        Habilidade::find($id)->update($values);
        return redirect()->route('gestao.habilidades.listar')->with('message', 'Habilidade atualizada com sucesso!');
    }


    public function delete(Request $request)
    {
        Habilidade::find($request->idHabilidade)->delete();
        return redirect()->route('gestao.habilidades.listar')->with('message', 'Habilidade excluída com sucesso!');
    }

}
