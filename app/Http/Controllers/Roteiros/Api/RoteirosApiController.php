<?php
/*
namespace App\Http\Controllers\Roteiros\Api;

use App\Entities\Roteiro\Roteiro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoteiroApiController extends Controller
{
    public function listar($filter = null)
    {
        try {
            if ($filter !== null) {
                return response()->json(Roteiro::where('categoria_id', $filter)->orderBy('id', 'DESC')->get());
            }
            return response()->json(Roteiro::orderBy('id', 'DESC')->get());
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao listar.", "message:" => $exception->getMessage()]);
        }
    }




    public function show($idRoteiro)
    {
        try {
            $Roteiro = Roteiro::find($idRoteiro);
            if (!$Roteiro) {
                return response()->json(['error' => 'Nenhum áudio foi encontrado']);
            }
            return response()->json($Roteiro);
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao encontrar", "message:" => $exception->getMessage()]);
        }
    }

}
