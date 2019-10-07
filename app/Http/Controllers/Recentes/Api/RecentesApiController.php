<?php

namespace App\Http\Controllers\Recentes\Api;


use App\Entities\Recente\Recente;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecentesApiController extends Controller
{
    public function listar()
    {
        try {
            $recentes = Recente::where('user_id', Auth::user()->id)
                ->with(['albums' => function ($query) {
                    $query->select('albums.id', 'albums.titulo', 'albums.capa as url', 'albums.descricao', 'albums.categoria', 'albums.user_id as artist', 'albums.user_id');
                }])
                ->whereHas('albums')
                ->orderBy('id', 'DESC')
                ->limit(5)
                ->get();
            return response()->json($recentes);
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao listar.", "message:" => $exception->getMessage()]);
        }

    }




    public function store(Request $request)
    {
        try {
            $exists = Recente::where([['user_id', Auth::user()->id], ['album_id', $request->get('album_id')]])->exists();
            if ($exists) {
                Recente::find($exists->id)->update(['created_at' => Carbon::now()]);
                return response()->json(true);
            }

            if (Recente::where('user_id', Auth::user()->id)->get()->count() >= 5) {
                $check = Recente::where('user_id', Auth::user()->id)->latest()->first();
                $check->delete();
                Recente::create(['user_id' => Auth::user()->id, 'album_id' => $request->get('album_id')]);
                return response()->json(true);
            }

            Recente::create(['user_id' => Auth::user()->id, 'album_id' => $request->get('album_id')]);
            return response()->json(true);

        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao gravar.", "message:" => $exception->getMessage()]);
        }

    }
}
