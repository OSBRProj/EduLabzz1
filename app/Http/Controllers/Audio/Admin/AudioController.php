<?php

namespace App\Http\Controllers\Audio\Admin;

use Illuminate\Support\Facades\Input;

use App\Categoria;
use App\Entities\Audio\Audio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
    public function index()
    {
        $audios = Audio::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $audios->when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $audios = $audios
        ->where('user_id', Auth::user()->id)
        ->orderBy('id', 'DESC')
        ->get();

        $categorias = Categoria::where('tipo', 5)->select('id', 'titulo')->get();

        return view('pages.audios.admin.index', compact('categorias', 'audios'));
    }

    public function store(Request $request)
    {
        $mimesTypesValidation = ['audio/mp3', 'audio/wav'];
        $sizeValidation = 5000000;

        $this->validate($request, ['titulo' => 'required', 'categoria_id' => 'required', 'file' => 'required']);

        $file = $request->file('file');
        if (array_search($file->getClientMimeType(), $mimesTypesValidation) === false) {
            return redirect()->route('gestao.audios.listar')->withErrors(['Arquivo não aceito.']);
        }

        if ($file->getClientSize() > $sizeValidation) {
            return redirect()->route('gestao.audios.listar')->withErrors(['Arquivo muito grande!']);
        }

        $fileExtension = \File::extension($request->file->getClientOriginalName());
        $newFileNameAudio = md5($request->file->getClientOriginalName() . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;

        $pathFile = $request->file->storeAs('audios/user_id_' . Auth::user()->id, $newFileNameAudio, 'public_uploads');

        if (!Storage::disk('public_uploads')->put($pathFile, file_get_contents($request->file))) {
            \Session::flash('middle_popup', 'Ops! Não foi possivel enviar seu áudio.');
            \Session::flash('popup_style', 'danger');
        }

        Audio::create([
            'user_id'      => Auth::user()->id,
            'categoria_id' => $request->get('categoria_id'),
            'titulo'       => $request->get('titulo'),
            'descricao'    => $request->get('descricao'),
            'file'         => $newFileNameAudio,
            'duracao'      => $request->get('duracao')
        ]);

        return redirect()->route('gestao.audios.listar')->with('message', 'Áudio cadastrado com sucesso!');
    }




    public function update(Request $request, $idAudio)
    {
        $mimesTypesValidation = ['audio/mp3', 'audio/wav'];
        $sizeValidation = 5000000;

        $this->validate($request, ['titulo' => 'required']);

        $file = $request->get('audio_atual');

        if ($request->file) {
            if (array_search($request->file->getClientMimeType(), $mimesTypesValidation) === false) {
                return redirect()->route('gestao.audios.listar')->withErrors(['Arquivo não aceito.']);
            }

            if ($request->file->getClientSize() > $sizeValidation) {
                return redirect()->route('gestao.audios.listar')->withErrors(['Arquivo muito grande!']);
            }

            if (Storage::disk('public_uploads')->has('audios/user_id_' . Auth::user()->id . '/' . $file)) {
                Storage::disk('public_uploads')->delete('audios/user_id_' . Auth::user()->id . '/' . $file);
            }

            $fileExtension = \File::extension($request->file->getClientOriginalName());
            $file = md5($request->file->getClientOriginalName() . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;

            $pathFile = $request->file->storeAs('audios/user_id_' . Auth::user()->id, $file, 'public_uploads');

            if (!Storage::disk('public_uploads')->put($pathFile, file_get_contents($request->file))) {
                \Session::flash('middle_popup', 'Ops! Não foi possivel enviar seu áudio.');
                \Session::flash('popup_style', 'danger');
            }
        }


        $audio = Audio::find($idAudio);

        $r = $audio->update([
            'categoria_id' => $request->get('categoria_id'),
            'titulo'       => $request->get('titulo'),
            'descricao'    => $request->get('descricao'),
            'file'         => $file,
            'duracao'      => $request->get('duracao')
        ]);

        return redirect()->route('gestao.audios.listar')->with('message', 'Áudio atualizado com sucesso!');
    }




    public function destroy($idAudio)
    {
        $audio = Audio::find($idAudio);

        if (!$audio) {
            return redirect()->back()->withErrors(['Áudio não encontrado!']);
        }

        if (Storage::disk('public_uploads')->has('audios/user_id_' . Auth::user()->id . '/' . $audio->file)) {
            Storage::disk('public_uploads')->delete('audios/user_id_' . Auth::user()->id . '/' . $audio->file);
        }

        if ($audio->albuns->toArray() != null) {
            $audio->albuns()->detach();
        }

        if ($audio->playlists->toArray() != null) {
            $audio->playlists()->detach();
        }

        $audio->delete();
        return redirect()->route('gestao.audios.listar')->with('message', 'Áudio excluido com sucesso!');

    }


}
