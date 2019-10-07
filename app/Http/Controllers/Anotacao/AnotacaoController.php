<?php

namespace App\Http\Controllers\Anotacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;

use App\Entities\Anotacao\Anotacao;

class AnotacaoController extends Controller
{
    public function nova(Request $request)
    {
        if(!Auth::check())
        {
            return response()->json(['error' => 'Você precisa estar logado para realizar anotações!']);
        }
        elseif(Auth::user()->id == null)
        {
            return response()->json(['error' => 'Você precisa estar logado para realizar anotações!']);
        }

        if($request->trecho == null)
            $request->trecho = '';

        if($request->anotacao == null)
            $request->anotacao = '';

        if($request->pos_y == null)
            $request->pos_y = 0;
        if($request->pos_x == null)
            $request->pos_x = 0;
        if($request->start == null)
            $request->start = 0;
        if($request->end == null)
            $request->end = 0;

        $anotacao = Anotacao::create([
            'user_id' => Auth::id(),
            'conteudo_id' => $request->conteudo_id,
            'pagina' => $request->pagina,
            'trecho' => $request->trecho,
            'anotacao' => $request->anotacao,
            'pos_y' => $request->pos_y,
            'pos_x' => $request->pos_x,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return response()->json(['success' => 'Anotação criada com sucesso!', 'anotacao_id' => $anotacao->id, 'anotacao' => $anotacao]);

    }

    public function deletar($conteudo_id, $anotacao_id)
    {
        if(Anotacao::where([['id', '=', $anotacao_id], ['user_id', '=', Auth::id()], ['conteudo_id', '=', $conteudo_id]])->first() != null)
        {
            Anotacao::find($anotacao_id)->where([['user_id', '=', Auth::id()], ['conteudo_id', '=', $conteudo_id]])->first()->delete();

            return response()->json(['success' => 'Anotação deletada com sucesso!']);
        }
        else
        {
            return response()->json(['error' => 'Anotação não encontrado!']);
        }

    }
}
