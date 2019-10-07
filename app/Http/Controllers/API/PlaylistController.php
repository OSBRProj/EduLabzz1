<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Entities\Playlist\Playlist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = JWTAuth::toUser();

      try {
        $playlists = Playlist::where("user_id", $user->id)->orderBy("id", "DESC")
            ->select("playlists.id", "playlists.user_id", "playlists.user_id as artist", "playlists.titulo", "playlists.created_at")
            ->with(["audios" => function ($query) {
                $query->select("audios.id", "audios.titulo as title", "audios.user_id as artist", "audios.file as url", "audios.descricao");
            }])
            ->get();

        return response()->json(["data" => $playlists]);
      } catch (\Exception $exception) {
          return response()->json(["error" => "Erro ao listar.", "message" => $exception->getMessage()], 500);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = JWTAuth::toUser();
      $validate = Validator::make($request->all(), [
          "titulo"   => ["required"],
          "audio_id" => ["required"],
      ], [
          "audio_id.required" => "Selecione pelo menos 1 áudio em sua playlist."
      ]);

      if ($validate->fails())
          return response()->json(["error" => $validate->errors()], 500);

      try {
          $playlist = Playlist::create([
              "user_id" => $user->id,
              "titulo"  => $request->get("titulo")
          ]);
          $playlist->audios()->attach($request->get("audio_id"));
          return response()->json(["message" => "Playlist cadastrada com sucesso!"]);
      } catch (\Exception $exception) {
          return response()->json(["error" => $exception->getMessage()], 500);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = JWTAuth::toUser();

      try {
        $playlist = Playlist::where("user_id", $user->id)
            ->select("playlists.id", "playlists.user_id", "playlists.user_id as artist", "playlists.titulo", "playlists.created_at")
            ->with(["audios" => function ($query) {
                $query->select("audios.id", "audios.titulo as title", "audios.user_id as artist", "audios.file as url",
                    "audios.descricao");
            }])
            ->find($id);
        if (!$playlist) {
            return response()->json(["error" => "Nenhuma playlist foi encontrada"], 404);
        }
        return response()->json($playlist);
      } catch (\Exception $exception) {
          return response()->json(["error" => $exception->getMessage()], 500);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $user = JWTAuth::toUser();
      $validate = Validator::make($request->all(), ["titulo" => ["required"]]);

      if ($validate->fails())
        return response()->json(["error" => $validate->errors()], 500);

      try {
          Playlist::where("user_id", $user->id)->find($id)->update(["titulo" => $request->get("titulo")]);
          return response()->json(["message" => "Playlist atualizada com sucesso!"]);
      } catch (\Exception $exception) {
          return response()->json(["error" => $exception->getMessage()], 500);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        $playlist = Playlist::find($id);
        $playlist->audios()->detach();
        $playlist->delete();
        return response()->json(["message" => "Playlist removida com sucesso!"]);
      } catch (\Exception $exception) {
          return response()->json(["error" => $exception->getMessage()], 500);
      }
    }
}
