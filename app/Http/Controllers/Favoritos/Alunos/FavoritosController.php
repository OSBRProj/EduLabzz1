<?php

namespace App\Http\Controllers\Favoritos\Alunos;

use App\Entities\Favorito\Favorito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoritosController extends Controller
{
    public function index()
    {
        $favoritos = Favorito::where('user_id', Auth::user()->id)->get();
        return view('pages.favoritos.alunos.index', compact('favoritos'));
    }


    public function adiciona($idRef, $tipo)
    {
        if (Favorito::where([['user_id', Auth::user()->id], ['referencia_id', $idRef], ['tipo', $tipo]])->exists() === true) {
            return redirect()->route('biblioteca')->withErrors(['Este conteúdo já foi adicionado aos seus favoritos']);
        }
        Favorito::create([
            'user_id'       => Auth::user()->id,
            'referencia_id' => $idRef,
            'tipo'          => $tipo
        ]);
        return redirect()->route('biblioteca')->with('message', 'Conteúdo adicionado aos favoritos!');
    }


    public function search(Request $request)
    {
        $favoritos = Favorito::where('user_id', Auth::user()->id)
            ->with('conteudo')
            ->whereHas('conteudo', function ($query) use ($request) {
                $query->where('titulo', 'LIKE', '%' . $request->get('search') . '%');
            })->get();
        return view('pages.favoritos.alunos.index', compact('favoritos'));
    }


}
