<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AudioPlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idPlaylist, $idAudio)
    {
      $user = JWTAuth::toUser();

      try {
        $playlist = Playlist::where("user_id", $user->id)->find($idPlaylist);
        $playlist->audios()->attach($idAudio);
        return response()->json(["message" => "Playlist atualizada com sucesso!"]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idPlaylist, $idAudio)
    {
      $user = JWTAuth::toUser();

      $validate = Validator::make($request->all(), [
        "audio_id" => ["required"],
      ], [
          "audio_id.required" => "Selecione pelo menos 1 áudio em sua playlist."
      ]);

      if ($validate->fails())
        return response()->json(["error" => $validate->errors()]);

      try {
          $playlist = Playlist::where("user_id", $user->id)->find($idPlaylist);
          $playlist->audios()->sync($idAudio);
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
    public function destroy($idPlaylist, $idAudio)
    {
      $user = JWTAuth::toUser();

      try {
        $playlist = Playlist::where("user_id", $user->id)->find($idPlaylist);
        $playlist->audios()->detach($idAudio);
        return response()->json("Playlist atualizada com sucesso!");
      } catch (\Exception $exception) {
          return response()->json(["error" => $exception->getMessage()], 500);
      }
    }
}
