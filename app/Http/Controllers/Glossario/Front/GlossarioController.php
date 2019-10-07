<?php

namespace App\Http\Controllers\Glossario\Front;

use App\Entities\Glossario\Repository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Conteudo;

class GlossarioController extends Controller
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function index($word = 'A')
    {
        $glossarios = $this->repository->all($word);

        foreach ($glossarios as $key => $value)
        {
            $relacionados = Conteudo::
            where([['titulo', 'like', '%' . $value->word . '%']])
            ->orWhere([['descricao', 'like', '%' . $value->word . '%']])
            ->orWhere([['conteudo', 'like', '%' . $value->word . '%']])
            ->orWhere([['apoio', 'like', '%' . $value->word . '%']])
            ->orWhere([['fonte', 'like', '%' . $value->word . '%']])
            ->orWhere([['autores', 'like', '%' . $value->word . '%']])
            ->get();

            // dd($relacionados);

            $value->relacionados = $relacionados;
        }

        return view('pages.glossario.front.index', compact('glossarios', 'word'));
    }

    public function search(Request $request)
    {
        $word = ucfirst($request->get('word'));
        $glossarios = $this->repository->search($word);

        foreach ($glossarios as $key => $value)
        {
            $relacionados = Conteudo::
            where([['titulo', 'like', '%' . $value->word . '%']])
            ->orWhere([['descricao', 'like', '%' . $value->word . '%']])
            ->orWhere([['conteudo', 'like', '%' . $value->word . '%']])
            ->orWhere([['apoio', 'like', '%' . $value->word . '%']])
            ->orWhere([['fonte', 'like', '%' . $value->word . '%']])
            ->orWhere([['autores', 'like', '%' . $value->word . '%']])
            ->get();

            // dd($relacionados);

            $value->relacionados = $relacionados;
        }

        return view('pages.glossario.front.index', compact('glossarios', 'word'));
    }
}
