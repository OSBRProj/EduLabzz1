<?php

namespace App\Http\Controllers\Glossario\Admin;

use Illuminate\Support\Facades\Input;

use App\Entities\Glossario\Repository;
use App\Http\Requests\Glossario\Create;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Entities\Glossario\Glossario;

class GlossarioController extends Controller
{
    private $repository;

    public function __construct(Repository $repository)
    {
      $this->repository = $repository;
    }


    public function create($word)
    {
        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        if($tem_pesquisa)
        {
            $glossarios = $this->repository->search(Input::get('pesquisa'));

            // $word = strtoupper(substr(Input::get('pesquisa'), 0, 1));
            $word = null;
        }
        else
        {
            $glossarios = $this->repository->all($word);
        }

        return view('pages.glossario.admin.create')->with( compact('glossarios', 'word') );
    }

    public function delete(Request $request)
    {
      if(Glossario::find($request->idGlossario) != null)
      {
        Glossario::find($request->idGlossario)->delete();

        return redirect()->route('gestao.glossario.index')->with('success', 'Registro removido com sucesso!');
      }
      else
      {
        return redirect()->route('gestao.glossario.index')->with('error', 'Registro não encontrado!');
      }
    }

    public function store(Create $request)
    {
      $values = $request->all();
      $values['key'] = strtoupper(substr($request->get('word'), 0, 1));
      $this->repository->store($values);
      return redirect()->route('gestao.glossario', ['word' => $values['key']])->with('success', 'Registro adicionado com sucesso!');
    }

}
