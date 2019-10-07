<?php

namespace App\Http\Controllers\Playlist;

use Illuminate\Support\Facades\Input;

use App\Entities\Audio\Audio;
use App\Entities\Playlist\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $playlists->when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $is_admin = strtoupper(Auth::user()->permissao) == "Z";

        $playlists->when($is_admin == false, function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        });

        $playlists = $playlists
        ->orderBy('id', 'DESC')
        ->get();

        $audios = Audio::orderBy('id', 'DESC')->get();

        return view('pages.playlist.index', compact('playlists', 'audios'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'titulo'   => 'required',
            'audio_id' => 'required'
        ], [
            'audio_id.required' => 'Selecione pelo menos 1 áudio em sua playlist'
        ]);

        $playlist = Playlist::create([
            'user_id' => Auth::user()->id,
            'titulo'  => $request->get('titulo')
        ]);

        $playlist->audios()->attach($request->get('audio_id'));

        return redirect()->back()->with('message', 'Playlist cadastrada com sucesso!');
        // return redirect()->route('playlists.listar')->with('message', 'Playlist cadastrada com sucesso!');
    }




    public function update(Request $request, $idPlaylist)
    {
        $this->validate($request, [
            'titulo'   => 'required',
            'audio_id' => 'required'
        ], [
            'audio_id.required' => 'Selecione pelo menos 1 áudio em sua playlist'
        ]);

        $playlist = Playlist::find($idPlaylist);
        $playlist->update(['titulo' => $request->get('titulo')]);

        $playlist->audios()->sync($request->get('audio_id'));

        return redirect()->back()->with('message', 'Playlist atualizada com sucesso!');
        // return redirect()->route('playlists.listar')->with('message', 'Playlist atualizada com sucesso!');
    }




    public function destroy($idPlaylist)
    {
        $playlist = Playlist::find($idPlaylist);

        if (!$playlist)
        {
            return redirect()->back()->withErrors(['Playlist não encontrado!']);
        }

        $playlist->audios()->detach();

        $playlist->delete();

        return redirect()->back()->with('message', 'Playlist excluida com sucesso!');
        // return redirect()->route('playlists.listar')->with('message', 'Playlist excluida com sucesso!');
    }


}
