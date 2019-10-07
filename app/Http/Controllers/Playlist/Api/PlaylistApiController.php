<?php

namespace App\Http\Controllers\Playlist\Api;

use App\Entities\Playlist\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlaylistApiController extends Controller
{
    public function listar()
    {
        try {
            return response()->json(Playlist::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')
                ->select('playlists.id', 'playlists.user_id', 'playlists.user_id as artist', 'playlists.titulo',
                    'playlists.created_at')
                ->with(['audios' => function ($query) {
                    $query->select('audios.id', 'audios.titulo as title', 'audios.user_id as artist',
                        'audios.file as url', 'audios.descricao', 'audios.duracao as duration');
                }])
                ->get());
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao listar.", "message:" => $exception->getMessage()]);
        }
    }




    public function show($idPlaylist)
    {
        try {
            $playlist = Playlist::where('user_id', Auth::user()->id)
                ->select('playlists.id', 'playlists.user_id', 'playlists.user_id as artist', 'playlists.titulo',
                    'playlists.created_at')
                ->with(['audios' => function ($query) {
                    $query->select('audios.id', 'audios.titulo as title', 'audios.user_id as artist', 'audios.file as url',
                        'audios.descricao', 'audios.duracao as duration');
                }])
                ->find($idPlaylist);
            if (!$playlist) {
                return response()->json(['error' => 'Nenhuma playlist foi encontrada']);
            }
            return response()->json($playlist);
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao encontrar", "message:" => $exception->getMessage()]);
        }
    }




    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'titulo'   => ['required'],
            'audio_id' => ['required'],
        ], [
            'audio_id.required' => 'Selecione pelo menos 1 áudio em sua playlist.'
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => true, 'errorMessage' => $validate->errors()]);
        }
        try {
            $playlist = Playlist::create([
                'user_id' => Auth::user()->id,
                'titulo'  => $request->get('titulo')
            ]);
            $playlist->audios()->attach($request->get('audio_id'));
            return response()->json('Playlist cadastrada com sucesso!');
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao criar playlist", "message:" => $exception->getMessage()]);
        }
    }




    public function update(Request $request, $idPlaylist)
    {
        $validate = Validator::make($request->all(), ['titulo' => ['required']]);

        if ($validate->fails()) {
            return response()->json(['error' => true, 'errorMessage' => $validate->errors()]);
        }

        try {
            Playlist::where('user_id', Auth::user()->id)->find($idPlaylist)->update(['titulo' => $request->get('titulo')]);
            return response()->json('Playlist atualizada com sucesso!');
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao atualizar playlist", "message:" => $exception->getMessage()]);
        }
    }




    public function updateAudios(Request $request, $idPlaylist)
    {
        $validate = Validator::make($request->all(), [
            'audio_id' => ['required'],
        ], [
            'audio_id.required' => 'Selecione pelo menos 1 áudio em sua playlist.'
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => true, 'errorMessage' => $validate->errors()]);
        }

        try {
            $playlist = Playlist::where('user_id', Auth::user()->id)->find($idPlaylist);
            $playlist->audios()->sync($request->get('audio_id'));
            return response()->json('Playlist atualizada com sucesso!');
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao atualizar playlist", "message:" => $exception->getMessage()]);
        }
    }




    public function removeOneAudio(Request $request, $idPlaylist)
    {
        try {
            $playlist = Playlist::where('user_id', Auth::user()->id)->find($idPlaylist);
            $playlist->audios()->detach($request->get('audio_id'));
            return response()->json('Playlist atualizada com sucesso!');
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao atualizar playlist", "message:" => $exception->getMessage()]);
        }
    }




    public function storeOneAudio(Request $request, $idPlaylist)
    {
        try {
            $playlist = Playlist::where('user_id', Auth::user()->id)->find($idPlaylist);
            $playlist->audios()->attach($request->get('audio_id'));
            return response()->json('Playlist atualizada com sucesso!');
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao atualizar playlist", "message:" => $exception->getMessage()]);
        }
    }




    public function destroy($idPlaylist)
    {
        try {
            $playlist = Playlist::find($idPlaylist);
            $playlist->audios()->detach();
            $playlist->delete();
            return response()->json('Playlist removida com sucesso!');
        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao remover playlist", "message:" => $exception->getMessage()]);
        }


    }

}
