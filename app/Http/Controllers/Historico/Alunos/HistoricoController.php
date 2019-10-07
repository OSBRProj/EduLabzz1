<?php

namespace App\Http\Controllers\Historico\Alunos;

use App\Entities\Historico\Historico;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoricoController extends Controller
{
    public function index()
    {
        $historicos = Historico::where('user_id', Auth::user()->id)->groupBy('user_id', 'created_at', 'referencia_id')->get();
        return view('pages.historico.alunos.index', compact('historicos'));
    }


    public function search(Request $request)
    {
        $historicos = Historico::where('user_id', Auth::user()->id)
            ->with('conteudo')
            ->whereHas('conteudo', function ($query) use ($request) {
                $query->where('titulo', 'LIKE', '%' . $request->get('search') . '%');
            })
            ->orWhere('created_at', 'LIKE', '%' . $request->get('search') . '%')
            ->groupBy('user_id', 'created_at', 'referencia_id')
            ->get();
        return view('pages.historico.alunos.index', compact('historicos'));
    }
}
