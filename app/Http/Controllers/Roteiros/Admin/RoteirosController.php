<?php

namespace App\Http\Controllers\Roteiros\Admin;

use Illuminate\Support\Facades\Input;

use App\Entities\Roteiros\Roteiros;
use App\Entities\Roteiros\RoteirosTopico;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RoteirosController extends Controller
{
    public function index(Request $request)
    {
        $roteiros = Roteiros::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $roteiros->when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $is_admin = strtoupper(Auth::user()->permissao) == "Z";

        $roteiros->when($is_admin == false, function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        });

        $roteiros = $roteiros
        ->orderBy('id', 'DESC')
        ->get();

        foreach($roteiros as $r)
        {
            $topicosAtivos = 0;
            $topicosInativos = 0;

            $r->topicos->topicosAtivos = $topicosAtivos;
            $r->topicos->topicosInativos = $topicosInativos;

            foreach($r->topicos as $t)
            {
                if($t->status == 1)
                {
                    $r->topicos->topicosAtivos++;
                }
                else
                {
                    $r->topicos->topicosInativos++;
                }
            }
        }

        return view('pages.roteiros.admin.index', compact('roteiros'));
    }

    public function store(Request $request)
    {
        $roteiro = Roteiros::create([
            'user_id'   => Auth::user()->id,
            'titulo'    => $request->get('titulo'),
        ]);

        $roteiro->save();

        $lastInsertedId = $roteiro->id;

        if($request->get('topico'))
        {
            foreach($request->get('topico') as $t)
            {
                $topicos = RoteirosTopico::create([
                    'titulo' => $t['titulo'],
                    'roteiro_id' => $lastInsertedId,
                    'status' => 0
                ]);
            }
        }

        return redirect('gestao/roteiros')->with('success', 'Roteiro cadastrado com sucesso!');
    }

    public function view(Request $request, $idRoteiro)
    {
        $roteiro = Roteiros::find($idRoteiro);
    }

    public function update(Request $request, $idRoteiro)
    {
        $roteiro = Roteiros::find($idRoteiro);

        // atualiza
        $roteiro->update([
            'titulo'    => $request->get('titulo')
        ]);

        $roteiro->topicos()->delete();
        if($request->get('topico'))
        {
            foreach($request->get('topico') as $t)
            {
                $tituloRoteiro = $t['titulo'];

                $statusTopico = isset($t['status']) ? ($t['status'] == 1 ? 1 : 0) : 0;

                $topicos = RoteirosTopico::create([
                    'titulo' => $tituloRoteiro,
                    'roteiro_id' => $idRoteiro,
                    'status' => $statusTopico
                ]);
            }
        }

        return redirect('gestao/roteiros')->with('message', 'Roteiro atualizado com sucesso!');
    }

    public function ajaxUpdateStatusTopico(Request $request)
    {
        $idTopico = $request->post('id');
        $statusTopico = $request->post('status');

        $update = RoteirosTopico::find($idTopico)->update(['status' => $statusTopico]);

        return $statusTopico;
    }


    public function destroy($idRoteiro)
    {
        $roteiro = Roteiros::find($idRoteiro);

        if (!$roteiro) {
            return redirect()->back()->withErrors(['Roteiro não encontrado!']);
        }

        $roteiro->topicos()->delete();
        $roteiro->delete();

        return redirect('gestao/roteiros')->with('message', 'Roteiro excluído com sucesso!');
    }

}
