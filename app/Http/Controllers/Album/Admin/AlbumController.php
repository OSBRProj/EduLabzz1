<?php

namespace App\Http\Controllers\Album\Admin;

use Illuminate\Support\Facades\Input;

use App\Categoria;
use App\Entities\Album\Album;
use App\Entities\Audio\Audio;
use App\Generals\Upload\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    private $resize;

    public function __construct(Upload $resize)
    {
        $this->resize = $resize;
    }

    public function index()
    {
        $albuns = Album::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $albuns->when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $is_admin = strtoupper(Auth::user()->permissao) == "Z";

        $albuns->when($is_admin == false, function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        });

        $albuns = $albuns
        ->orderBy('id', 'DESC')
        ->get();

        $categorias = Categoria::where('tipo', 5)->select('id', 'titulo')->get();

        (Auth::user()->permissao == 'Z' ? $audios = Audio::orderBy('id', 'DESC')->get() : $audios = Audio::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get());

        return view('pages.albums.admin.index', compact('albuns', 'audios', 'categorias'));
    }

    public function create()
    {
        $categorias = Categoria::where('tipo', 5)->select('id', 'titulo')->get();
        (Auth::user()->permissao == 'Z' ? $audios = Audio::orderBy('id', 'DESC')->get() : $audios = Audio::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get());
        return view('pages.albums.admin.create', compact('categorias', 'audios'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['titulo' => 'required', 'categoria']);

        $album = Album::create([
            'user_id'   => Auth::user()->id,
            'titulo'    => $request->get('titulo'),
            'categoria' => $request->get('categoria'),
            'descricao' => $request->get('descricao')
        ]);

        if ($request->get('audio_id')) {
            $album->audios()->attach($request->get('audio_id'));
        }

        if ($request->capa != null) {
            $fileExtension = \File::extension($request->capa->getClientOriginalName());
            $newFileNameCapa = md5($request->capa->getClientOriginalName() . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;

            $pathCapa = $request->capa->storeAs('albuns/capas', $newFileNameCapa, 'public_uploads');


            $this->resize->makeSimpleResize($request->capa, 100, 'albuns/capas/app', $newFileNameCapa);


            if (
                !Storage::disk('public_uploads')->put($pathCapa, file_get_contents($request->capa)) ||
                !$this->resize->makeSimpleResize($request->capa, 100, 'albuns/capas/app', $newFileNameCapa)) {
                \Session::flash('middle_popup', 'Ops! Não foi possivel enviar a capa.');
                \Session::flash('popup_style', 'danger');
            } else {
                $album->capa = $newFileNameCapa;
                $album->save();
            }
        }
        return redirect()->back()->with('message', 'Álbum cadastrado com sucesso!');
    }




    public function edit($idAlbum)
    {
        $categorias = Categoria::where('tipo', 5)->select('id', 'titulo')->get();
        (Auth::user()->permissao == 'Z' ? $audios = Audio::orderBy('id', 'DESC')->get() : $audios = Audio::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get());
        $album = Album::find($idAlbum);
        return view('pages.albums.admin.edit', compact('categorias', 'audios', 'album'));
    }




    public function update(Request $request, $idAlbum)
    {
        $this->validate($request, ['titulo' => 'required', 'categoria']);
        $capa = $request->get('capa_atual');
        if ($request->file('capa')) {

            if (Storage::disk('public_uploads')->has('albuns/capas/' . $capa)) {
                Storage::disk('public_uploads')->delete('albuns/capas/' . $capa);
                Storage::disk('public_uploads')->delete('albuns/capas/app/' . $capa);
            }

            $fileExtension = \File::extension($request->capa->getClientOriginalName());
            $newFileNameCapa = md5($request->capa->getClientOriginalName() . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;

            $pathCapa = $request->capa->storeAs('albuns/capas', $newFileNameCapa, 'public_uploads');

            if (!Storage::disk('public_uploads')->put($pathCapa, file_get_contents($request->capa)) ||
                !$this->resize->makeSimpleResize($request->capa, 100, 'albuns/capas/app', $newFileNameCapa)) {
                \Session::flash('middle_popup', 'Ops! Não foi possivel enviar a capa.');
                \Session::flash('popup_style', 'danger');
            } else {
                $capa = $newFileNameCapa;
                Storage::disk('public_uploads')->delete('albuns/capas/' . $request->get('capa_atual'));
                Storage::disk('public_uploads')->delete('albuns/capas/app/' . $request->get('capa_atual'));
            }
        }


        $album = Album::find($idAlbum);
        $album->update([
            'titulo'    => $request->get('titulo'),
            'capa'      => $capa,
            'descricao' => $request->get('descricao'),
            'categoria' => $request->get('categoria')
        ]);

        if (!$request->get('audio_id')) {
            $album->audios()->detach();
        }
        $album->audios()->sync($request->get('audio_id'));

        return redirect()->route('gestao.albuns.listar')->with('message', 'Álbum atualizado com sucesso!');
    }




    public function destroy($idAlbum)
    {
        $album = Album::find($idAlbum);

        if (!$album) {
            return redirect()->back()->withErrors(['Álbum não encontrado!']);
        }

        if (Storage::disk('public_uploads')->has('albuns/capas/' . $album->capa)) {
            Storage::disk('public_uploads')->delete('albuns/capas/' . $album->capa);
            Storage::disk('public_uploads')->delete('albuns/capas/app/' . $album->capa);
        }

        if ($album->audios->toArray()) {
            $album->audios()->detach();
        }
        $album->delete();

        return redirect()->route('gestao.albuns.listar')->with('message', 'Álbum excluida com sucesso!');

    }
}
