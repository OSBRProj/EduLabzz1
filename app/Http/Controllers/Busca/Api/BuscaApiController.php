<?php

namespace App\Http\Controllers\Busca\Api;

use App\Entities\Album\Album;
use App\Entities\Playlist\Playlist;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BuscaApiController extends Controller
{


    public function listar(Request $request)
    {

        try {
            if ($request->get('text') != '') {

                $albums = Album::orderBy('id', 'DESC')
                    ->select('albums.id', 'albums.titulo', 'albums.capa as url', 'albums.descricao', 'albums.categoria',
                        'albums.user_id as artist', 'albums.user_id')
                    ->where('titulo', 'LIKE', '%' . $request->get('text') . '%')
                    /*->with(['audios' => function ($query) {
                        $query->select('audios.id', 'audios.titulo as title', 'audios.user_id as artist',
                            'audios.file as url', 'audios.descricao', 'audios.duracao as duration');
                    }])*/
                    ->get();

                $playlists = Playlist::orderBy('id', 'DESC')
                    ->where([['user_id', Auth::user()->id], ['titulo', 'LIKE', '%' . $request->get('text') . '%']])
                    ->select('playlists.id', 'playlists.user_id', 'playlists.user_id as artist', 'playlists.titulo', 'playlists.created_at')
                    /*->with(['audios' => function ($query) {
                        $query->select('audios.id', 'audios.titulo as title', 'audios.user_id as artist',
                            'audios.file as url', 'audios.descricao');
                    }])*/
                    ->get();

                $artists = User::orderBy('name', 'ASC')
                    ->select('users.id', 'users.name')
                    ->where('name', 'LIKE', '%' . $request->get('text') . '%')
                    ->with(['albuns' => function ($query) {
                        $query->select('albums.id', 'albums.titulo', 'albums.capa as url', 'albums.descricao', 'albums.categoria',
                            'albums.user_id as artist', 'albums.user_id');

                    }])
                    ->has('albuns')
                    ->get();

                $artistsAlbuns = [];
                foreach ($artists as $artist) {
                    $artistsAlbuns = $artist->albuns;
                }

                return response()->json([
                    'albums'    => ($albums->count() > 0 ? $albums : false),
                    'playlists' => ($playlists->count() > 0 ? $playlists : false),
                    'artists'   => (empty($artistsAlbuns) ? false : $artistsAlbuns)
                ]);

            }

            return null;

        } catch (\Exception $exception) {
            return response()->json(["error" => "Erro ao buscar.", "message:" => $exception->getMessage()]);
        }
    }

}
