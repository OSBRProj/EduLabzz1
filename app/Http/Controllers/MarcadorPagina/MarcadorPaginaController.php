<?php

namespace App\Http\Controllers\MarcadorPagina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Redirect;
use Session;
use Auth;

use App\User;

use App\Conteudo;

use App\Entities\Anotacao\Anotacao;
use App\Entities\MarcadorPagina\MarcadorPagina;

class MarcadorPaginaController extends Controller
{
    public function paginaMarcada($conteudo_id)
    {
        $paginaMarcada = null;

        if(MarcadorPagina::where([['user_id', '=', Auth::id()], ['conteudo_id', '=', $conteudo_id]])->exists())
        {
            $paginaMarcada = MarcadorPagina::where([['user_id', '=', Auth::id()], ['conteudo_id', '=', $conteudo_id]])->latest()->first()->pagina;
        }

        return response()->json(['response' => true, "paginaMarcada" => $paginaMarcada]);
    }

    public function marcarPagina($conteudo_id, $paginaAtual)
    {
        // if(MarcadorPagina::where([['user_id', '=', Auth::id()], ['conteudo_id', '=', $conteudo_id], ['pagina', '=', $paginaAtual]])->first() == null)
        // {
        //     MarcadorPagina::create([
        //         'user_id' => Auth::id(),
        //         'conteudo_id' => $conteudo_id,
        //         'pagina' => $paginaAtual,
        //     ]);
        // }

        MarcadorPagina::updateOrCreate(
            [
                'user_id' => Auth::id(), 'conteudo_id' => $conteudo_id
            ],
            [
                'pagina' => $paginaAtual
        ]);

        return response()->json(['success' => 'Pagina marcada com sucesso!']);
    }

    public function deletarMarcador($conteudo_id, $pagina)
    {
        if(MarcadorPagina::where([['user_id', '=', Auth::id()], ['conteudo_id', '=', $conteudo_id], ['pagina', '=', $pagina]])->first() != null)
        {
            MarcadorPagina::where([['user_id', '=', Auth::id()], ['conteudo_id', '=', $conteudo_id], ['pagina', '=', $pagina]])->first()->delete();
        }

        return response()->json(['success' => 'Marcador deletado com sucesso!']);
    }
}
