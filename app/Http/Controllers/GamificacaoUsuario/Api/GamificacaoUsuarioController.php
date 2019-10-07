<?php

namespace App\Http\Controllers\GamificacaoUsuario\Api;

use App\Entities\GamificacaoUsuario\GamificacaoUsuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GamificacaoUsuarioController extends Controller
{
    
    public function incrementar($idUsuario, Request $request)
    {
        try {
            $user = GamificacaoUsuario::where('user_id', $idUsuario)->first();
            if (empty($user) === true) {
                GamificacaoUsuario::create(['user_id' => $idUsuario, 'xp' => $request->get('xp')]);
            } else {
                $xp = GamificacaoUsuario::where('user_id', $idUsuario)->first();
                GamificacaoUsuario::find($xp->id)->update(['xp' => $xp->xp + $request->get('xp')]);
            }
            
            return response()->json(["success" => "Incrementação adicionada com sucesso!"]);
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao registar a incrementação.", "message:" => $exception->getMessage()]);
        }
    }
    
    
    public function listar($idUsuario)
    {
        try {
            $xp = GamificacaoUsuario::where('user_id', $idUsuario)->select('xp')->first();
            return response()->json($xp);
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao listar.", "message:" => $exception->getMessage()]);
        }
    }
}
