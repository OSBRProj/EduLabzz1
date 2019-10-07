<?php

namespace App\Http\Controllers\AudioInteracoes\Admin;

use Illuminate\Support\Facades\Input;

use App\Entities\Audio\Audio;
use App\Entities\AudioInteracoes\AudioInteracoes;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AudioInteracoesController extends Controller
{
    public function index(Request $request)
    {
        $audios = Audio::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $audios->when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $is_admin = strtoupper(Auth::user()->permissao) == "Z";

        $audios->when($is_admin == false, function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        });

        $audios = $audios
        ->orderBy('id', 'DESC')
        ->get();

        return view('pages.audios-interacoes.admin.index', compact('audios'));
    }

    public function store(Request $request)
    {
        $audioInteracao = AudioInteracoes::create([
            'user_id'   => Auth::user()->id,
            'audio_id'  => $request->get('audio_id'),
            'titulo'    => $request->get('titulo'),
            'descricao' => $request->get('descricao'),
            'inicio'    => $request->get('inicio'),
            'fim'       => $request->get('fim'),
        ]);

        return redirect('gestao/audios-interacoes/'.$request->get('audio_id').'/view')->with('message', 'Interação adicionada com sucesso!');
    }

    public function view($idAudio)
    {
        $audio = Audio::find($idAudio);

        return view('pages.audios-interacoes.admin.view', compact('audio'));
    }

    public function update(Request $request, $idAudioInteracao)
    {
        $audioInteracao = AudioInteracoes::find($idAudioInteracao);

        $audioInteracao->update([
            'id'        => $idAudioInteracao,
            'audio_id'  => $request->get('audio_id'),
            'titulo'    => $request->get('titulo'),
            'descricao' => $request->get('descricao'),
            'inicio'    => $request->get('inicio'),
            'fim'       => $request->get('fim')
        ]);

        return redirect('gestao/audios-interacoes/'.$request->get('audio_id').'/view')->with('message', 'Interação atualizada com sucesso!');
    }

    public function destroy(Request $request, $idAudioInteracao)
    {
        $audioInteracao = AudioInteracoes::find($idAudioInteracao);

        if (!$audioInteracao) {
            return redirect()->back()->withErrors(['Interação não encontrada!']);
        }

        $audioInteracao->delete();

        return redirect('gestao/audios-interacoes/'.$request->get('audio_id').'/view')->with('message', 'Interação excluída com sucesso!');
    }

}
