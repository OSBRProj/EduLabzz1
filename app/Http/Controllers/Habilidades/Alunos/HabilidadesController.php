<?php

namespace App\Http\Controllers\Habilidades\Alunos;

use App\Entities\Habilidade\Habilidade;
use App\Entities\HabilidadeUsuario\HabilidadeUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HabilidadesController extends Controller
{

    public function index()
    {
        $categorias = Habilidade::select('categoria')->distinct('categoria')->get();//->unique();

        // dd($categorias);

        $habilidades = Habilidade::orderBy('id', 'asc')->get();

        $habilidadesUsuario = HabilidadeUsuario::
        with('habilidade')
        ->where('user_id', Auth::user()->id)
        ->get();

        // dd($habilidades);

        foreach ($categorias as $key => $categoria)
        {
            $categoria->total_pontos = HabilidadeUsuario::with('habilidade')->where([['user_id', Auth::user()->id]])
            ->whereHas('habilidade', function ($query) use ($categoria) {
                $query->where([['categoria', '=', $categoria->categoria]]);
            })
            ->sum('pontos');

            $categoria->total_habilidades = Habilidade::where([['categoria', '=', $categoria->categoria]])->count();
        }

        foreach ($habilidades as $key => $habilidade)
        {
            $habilidade->pontos = HabilidadeUsuario::where([['user_id', Auth::user()->id], ['habilidade_id', '=', $habilidade->id]])
            ->sum('pontos');
        }

        return view('pages.habilidades.alunos.index', compact('categorias', 'habilidades'));
    }

    public function estatisticas()
    {
        return view('pages.habilidades.alunos.estatisticas');
    }

}
