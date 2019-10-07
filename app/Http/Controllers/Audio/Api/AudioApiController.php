<?php

namespace App\Http\Controllers\Audio\Api;

use App\Entities\Audio\Audio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AudioApiController extends Controller
{
    public function listar($filter = null)
    {
        try {
            if ($filter !== null) {
                return response()->json(Audio::where('categoria_id', $filter)->orderBy('id', 'DESC')->get());
            }
            return response()->json(Audio::orderBy('id', 'DESC')->get());
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao listar.", "message:" => $exception->getMessage()]);
        }
    }




    public function show($idAudio)
    {
        try {
            $audio = Audio::find($idAudio);
            if (!$audio) {
                return response()->json(['error' => 'Nenhum áudio foi encontrado']);
            }
            return response()->json($audio);
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao encontrar", "message:" => $exception->getMessage()]);
        }
    }

}
