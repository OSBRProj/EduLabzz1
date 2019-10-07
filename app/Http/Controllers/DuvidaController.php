<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\User;
use App\Conteudo;
use App\Metrica;
use App\AvaliacaoInstrutor;
use App\DuvidaProfessor;
use App\ComentarioDuvidaProfessor;
use App\Turma;

class DuvidaController extends Controller
{
    public function index($idProfessor)
    {
        $professor = User::with('escola')->find($idProfessor);

        if($professor == null)
        {
            return redirect()->back()->withErrors("Professor não encontrado!");
        }
        else if(strtoupper($professor->permissao) != "P" && strtoupper($professor->permissao) != "G" && strtoupper($professor->permissao) != "Z")
        {
            return redirect()->back()->withErrors("Professor não encontrado!");
        }

        if(AvaliacaoInstrutor::where('instrutor_id', '=', $idProfessor)->avg('avaliacao') > 0)
            $avaliacaoInstrutor = AvaliacaoInstrutor::where('instrutor_id', '=', $idProfessor)->avg('avaliacao');
        else
            $avaliacaoInstrutor = '-';

        $duvidas = DuvidaProfessor::where([['professor_id', '=', $idProfessor]])
        ->orderBy('status', 'asc')
        ->orderBy('created_at', 'desc')
        ->get();
        // ->sortBy('status');

        foreach ($duvidas as $duvida)
        {
            $duvida->qt_comentarios = ComentarioDuvidaProfessor::where([['duvida_id', '=', $duvida->id]])->count();
        }

        // dd($duvidas);

        return view('duvidas-professor')->with(compact('duvidas', 'professor', 'avaliacaoInstrutor'));
    }

    public function postNovaDuvida($idProfessor, Request $request)
    {
        if(User::find($idProfessor) == null)
        {
            Redirect::back()->withErrors(['Professor não encontrado!']);
        }
        else
        {
            $duvida = DuvidaProfessor::create([
                'professor_id' => $idProfessor,
                'user_id' => Auth::user()->id,
                'titulo' => $request->titulo,
                'descricao' => $request->descricao
            ]);

            return Redirect::back()->with('message', 'Dúvida enviada com sucesso!');
        }
    }

    public function duvida($idProfessor, $idDuvida)
    {
        $duvida = DuvidaProfessor::with('professor', 'user', 'comentarios')->has('professor')->has('user')->find($idDuvida);

        // dd($duvida);

        if($duvida == null)
        {
            return redirect()->route('professor.duvidas', $idProfessor)->withErrors("Dúvida não encontrada!");
        }

        if(AvaliacaoInstrutor::where('instrutor_id', '=', $duvida->professor->id)->avg('avaliacao') > 0)
            $avaliacaoInstrutor = AvaliacaoInstrutor::where('instrutor_id', '=', $duvida->professor->id)->avg('avaliacao');
        else
            $avaliacaoInstrutor = '-';

        $turma = Turma::where([['user_id', '=', Auth::user()->id]])->first();

        return view('duvida-professor')->with(compact('turma', 'duvida', 'avaliacaoInstrutor'));
    }

    public function postAtualizarDuvida($idProfessor, $idDuvida, Request $request)
    {
        // dd($idDuvida);

        if(DuvidaProfessor::find($idDuvida) == null)
        {
            return Redirect::back()->withErrors(['Dúvida não encontrada!']);
        }
        else
        {
            DuvidaProfessor::find($idDuvida)->update([
                'status' => $request->status
            ]);

            return Redirect::back()->with('message', 'Dúvida atualizada com sucesso!');
        }
    }

    public function postExcluirDuvida($idProfessor, $idDuvida)
    {
        if(DuvidaProfessor::find($idDuvida) == null)
        {
            return Redirect::back()->withErrors(['Dúvida não encontrada!']);
        }
        else
        {
            DuvidaProfessor::find($idDuvida)->delete();

            return Redirect::back()->with('message', 'Dúvida excluída com sucesso!');
        }
    }

    public function postEnviarComentarioDuvida($idProfessor, $idDuvida, Request $request)
    {
        if(DuvidaProfessor::find($idDuvida) == null)
        {
            Redirect::back()->withErrors(['Dúvida não encontrada!']);
        }
        else
        {
            $comentario = ComentarioDuvidaProfessor::create([
                'duvida_id' => $idDuvida,
                'user_id' => Auth::user()->id,
                'conteudo' => $request->conteudo
            ]);

            return Redirect::back();//->with('message', 'Comentário enviado com sucesso!');
        }
    }

    public function postExcluirComentarioDuvida($idProfessor, $idDuvida, $idComentario)
    {
        if(ComentarioDuvidaProfessor::find($idComentario) == null)
        {
            return Redirect::back()->withErrors(['Comentário não encontrado!']);
        }
        else
        {
            ComentarioDuvidaProfessor::find($idComentario)->delete();

            return Redirect::back()->with('message', 'Comentário excluído com sucesso!');
        }
    }
}
