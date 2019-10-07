<?php

namespace App\Http\Controllers\Trilhas\Admin;

use Illuminate\Support\Facades\Input;

use App\Curso;
use App\Entities\Trilhas\Trilhas;
use App\Entities\Trilhas\TrilhasCurso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrilhasController extends Controller
{
    public function index()
    {
        $trilhas = Trilhas::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $trilhas->when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $is_admin = strtoupper(Auth::user()->permissao) == "Z";

        $trilhas->when($is_admin == false, function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        });

        $trilhas = $trilhas
        // ->where('user_id', Auth::user()->id)
        ->orderBy('id', 'DESC')
        ->get();

        return view('pages.trilhas.admin.index', compact('trilhas'));
    }

    public function create()
    {

        (Auth::user()->permissao == 'Z' ? $cursos = Curso::orderBy('id', 'DESC')->get() : $cursos = Curso::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get());
        return view('pages.trilhas.admin.create', compact('cursos'));
    }




    public function store(Request $request)
    {
        if (!$request->get('curso_id')) {
            return redirect()->back()->withErrors(['Selecione pelo menos um curso para sua trilha!'])->withInput();
        }
        $this->validate($request, [
            'titulo' => 'required',
            'capa'   => 'required'
        ]);

        $trilha = Trilhas::create([
            'user_id'   => Auth::user()->id,
            'titulo'    => $request->get('titulo'),
            'descricao' => $request->get('descricao'),
        ]);

        $trilha->cursos()->attach($request->get('curso_id'));

       /* foreach ($request->get('curso_id') as $cursoId) {
            TrilhasCurso::create([
                'trilha_id' => $trilha->id,
                'curso_id'  => $cursoId
            ]);
        }*/

        if ($request->capa != null) {
            $fileExtension = \File::extension($request->capa->getClientOriginalName());
            $newFileNameCapa = md5($request->capa->getClientOriginalName() . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;

            $pathCapa = $request->capa->storeAs('trilhas/capas', $newFileNameCapa, 'public_uploads');

            if (!Storage::disk('public_uploads')->put($pathCapa, file_get_contents($request->capa))) {
                \Session::flash('middle_popup', 'Ops! Não foi possivel enviar a capa.');
                \Session::flash('popup_style', 'danger');
            } else {
                $trilha->capa = $newFileNameCapa;
                $trilha->save();
            }
        }
        return redirect()->back()->with('message', 'Trilha cadastrada com sucesso!');
        // return redirect()->route('trilhas.index')->with('message', 'Trilha cadastrada com sucesso!');
    }




    public function edit($idTrilha)
    {
        (Auth::user()->permissao == 'Z' ? $cursos = Curso::orderBy('id', 'DESC')->get() : $cursos = Curso::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get());
        $trilha = Trilhas::find($idTrilha);

        return view('pages.trilhas.admin.edit', compact('trilha', 'cursos'));
    }




    public function update(Request $request, $idTrilha)
    {
        if (!$request->get('curso_id')) {
            return redirect()->back()->withErrors(['Selecione pelo menos um curso para sua trilha!'])->withInput();
        }
        $this->validate($request, ['titulo' => 'required']);

        $capa = $request->get('capa_atual');
        if ($request->file('capa')) {
            $fileExtension = \File::extension($request->capa->getClientOriginalName());
            $newFileNameCapa = md5($request->capa->getClientOriginalName() . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;

            $pathCapa = $request->capa->storeAs('trilhas/capas', $newFileNameCapa, 'public_uploads');

            if (!Storage::disk('public_uploads')->put($pathCapa, file_get_contents($request->capa))) {
                \Session::flash('middle_popup', 'Ops! Não foi possivel enviar a capa.');
                \Session::flash('popup_style', 'danger');
            } else {
                $capa = $newFileNameCapa;
                Storage::disk('public_uploads')->delete('trilhas/capas/' . $request->get('capa_atual'));
            }
        }


        $trilha = Trilhas::find($idTrilha);
        $trilha->update([
            'titulo'    => $request->get('titulo'),
            'capa'      => $capa,
            'descricao' => $request->get('descricao')
        ]);


        $trilha->cursos()->sync($request->get('curso_id'));


        return redirect()->route('gestao.trilhas.listar')->with('message', 'Trilha atualizada com sucesso!');


    }




    public function destroy($idTrilha)
    {
        $trilha = Trilhas::find($idTrilha);
        if (!$trilha) {
            return redirect()->back()->withErrors(['Trilha não encontrada!']);
        }

        if (Storage::disk('public_uploads')->has('trilhas/capas/' . $trilha->capa)) {
            Storage::disk('public_uploads')->delete('trilhas/capas/' . $trilha->capa);
        }


        TrilhasCurso::where('trilha_id', $idTrilha)->delete();
        $trilha->delete();

        return redirect()->back()->with('message', 'Trilha excluida com sucesso!');

    }


}
