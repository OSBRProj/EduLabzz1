<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Redirect;
use Session;
// use Request;

use App\Entities\GradeAula\GradeAula;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

use App\Escola;
use App\User;
use App\Turma;
use App\AlunoTurma;
use App\PostagemTurma;
use App\ComentarioPostagemTurma;
use App\Aplicacao;
use App\Conteudo;
use App\CodigoTransmissao;

class TurmaController extends Controller
{


    public function index()
    {
        if (strtoupper(Auth::user()->permissao) == "G") {
            $escola = Escola::where('user_id', '=', Auth::user()->id)->first();
        }

        if (!isset($escola)) {
            $escola = Escola::find(1);
        } elseif ($escola == null) {
            $escola = Escola::find(1);
        }

        $escola->caracteristicas = json_decode($escola->caracteristicas);

        if (\Request::is('gestao/turmas')) {
            if (strtoupper(Auth::user()->permissao) == "Z") {
                $turmas = Turma::with('user')->get();
            } elseif (strtoupper(Auth::user()->permissao) == "G") {
                $turmas = Turma::with('professor')->whereHas('professor', function ($q) {
                    $q->where('escola_id', '=', Auth::user()->escola_id);
                })->get();
            } elseif (strtoupper(Auth::user()->permissao) == "P") {
                $turmas = Turma::with('professor')->where('user_id', '=', Auth::user()->id)->get();
            }
        } else {
            $turmas = collect();

            foreach (AlunoTurma::where('user_id', '=', Auth::user()->id)->get() as $turma) {
                if (Turma::find($turma->turma_id) != null) {
                    $turmas->push(Turma::with('user')->find($turma->turma_id));
                }
            }
        }

        foreach ($turmas as $turma) {
            $turma->qt_alunos = AlunoTurma::where('turma_id', '=', $turma->id)->count();
        }

        return view('gestao.turmas')->with(compact('escola', 'turmas'));
    }


    public function gradeAulas($idTurma)
    {
        $events = [];
        $data = GradeAula::where('turma_id', $idTurma)->get();
        if ($data->count()) {
            foreach ($data as $key => $value) {
                $opts = [
                    'color'       => "$value->cor",
                    'textColor'   => '#FFFFFF',
                    'description' => $value->descricao,
                    'dow'         => [$value->dia],
                    'ranges'      => [$value->dia => ['start' => "$value->data_inicial", 'end' => '2020-01-01']]
                ];

                if ($value->recorrente == 0)
                {
                    unset($opts['dow']);
                    unset($opts['ranges']);
                }

                $events[] = Calendar::event(
                    $value->titulo,
                    false,
                    $value->data_inicial,
                    $value->data_final,
                    null,
                    $opts
                );
            }
        }

        $calendar = Calendar::addEvents($events)->setOptions([
            'columnFormat'    => 'ddd D',
            'allDaySlot'      => false,
            'defaultView'     => 'agendaWeek',
            'slotLabelFormat' => 'HH:mm',
            'minTime'         => '06:00:00',
            'maxTime'         => '24:00:00',
            'slotDuration'    => '01:00:00',
            'locale'          => 'pt-br',
            'contentHeight'   => 'auto',
            'firstDay'        => 1, // inicia na segunda
        ]);

        if (Turma::find($idTurma) == null)
        {
            Redirect::back()->withErrors(['Turma não encontrada!']);
        }
        else
        {
            $turma = Turma::with('professor', 'postagens_comentarios', 'escola')->find($idTurma);

            if (strpos(Auth::user()->permissao, "G") === false && strpos(Auth::user()->permissao, "Z") === false && $turma->user_id != Auth::user()->id && (AlunoTurma::where([['turma_id', '=', $idTurma], ['user_id', '=', Auth::user()->id]])->first() == null)) {
                Session::flash('error', 'Você não faz parte desta turma!');

                return redirect()->route('catalogo');
            }

            return view('gestao.turma-mural-grade')->with(compact('turma', 'calendar'));
        }
    }


    public function postNovaTurma(Request $request)
    {
        if (isset($request->descricao)) {
            if ($request->descricao == null)
                $request->descricao = "";
        } else {
            $request->descricao = "";
        }

        Turma::create([
            'user_id'   => Auth::user()->id,
            'titulo'    => $request->titulo,
            'descricao' => $request->descricao
        ]);

        return Redirect::back()->with('message', 'Turma criada com sucesso!');

    }

    public function postExcluirTurma(Request $request)
    {
        if (Turma::find($request->idTurma) == null) {
            Redirect::back()->withErrors(['Turma não encontrada!']);
        } else {
            Turma::find($request->idTurma)->delete();
            AlunoTurma::where('turma_id', '=', $request->idTurma)->delete();
            PostagemTurma::where('turma_id', '=', $request->idTurma)->delete();

            return Redirect::back()->with('message', 'Turma excluída com sucesso!');
        }
    }

    public function postSairTurma(Request $request)
    {
        if (Turma::find($request->idTurma) == null) {
            Redirect::back()->withErrors(['Turma não encontrada!']);
        } else {
            AlunoTurma::where([['turma_id', '=', $request->idTurma], ['user_id', '=', Auth::user()->id]])->delete();

            // return redirect()->route('catalogo');
            return Redirect::back()->with('message', 'Turma deixada com sucesso!');
        }
    }

    public function postConvidarAlunos($idTurma, Request $request)
    {
        $count = 0;
        // dd($request);
        for ($i = 0; $i < 10; $i++) {
            if ($request->get('email_aluno' . ($i + 1)) == null) {
                continue;
            }

            if ($request->has('email_aluno' . ($i + 1)) == false) {
                break;
            }

            $email_aluno = $request->get('email_aluno' . ($i + 1));

            if (User::where('email', '=', $email_aluno)->first() != null) {
                if (AlunoTurma::where([['turma_id', '=', $idTurma], ['user_id', '=', User::where('email', '=', $email_aluno)->first()->id]])->first() == null) {
                    AlunoTurma::create([
                        'turma_id' => $idTurma,
                        'user_id'  => User::where('email', '=', $email_aluno)->first()->id
                    ]);

                    $count++;
                }
            }
        }

        return Redirect::back()->with('message', $count . ' aluno' . ($count != 1 ? 's' : '') . ' convidado' . ($count != 1 ? 's' : '') . ' com sucesso!');
    }

    public function removerAluno($idTurma, $idAluno)
    {
        if (Turma::find($idTurma) == null) {
            return response()->json(['error' => 'Turma não encontrada!']);
        } else {
            if (AlunoTurma::where([['turma_id', '=', $idTurma], ['user_id', '=', $idAluno]])->first() != null) {
                AlunoTurma::where([['turma_id', '=', $idTurma], ['user_id', '=', $idAluno]])->delete();

                return response()->json(['success' => 'Aluno removido com sucesso!']);
            } else {
                return response()->json(['error' => 'Aluno não encontrado!']);
            }

        }
    }

    public function muralTurma($idTurma)
    {
        if (Input::get('qt') == null)
        {
            $amount = 10;
        }
        else
        {
            $amount = Input::get('qt');
        }

        if (Turma::find($idTurma) == null)
        {
            Redirect::back()->withErrors(['Turma não encontrada!']);
        }
        else
        {
            $turma = Turma::with('professor', 'postagens_comentarios', 'escola')->find($idTurma);

            if (strpos(Auth::user()->permissao, "G") === false && strpos(Auth::user()->permissao, "Z") === false && $turma->user_id != Auth::user()->id && (AlunoTurma::where([['turma_id', '=', $idTurma], ['user_id', '=', Auth::user()->id]])->first() == null)) {
                Session::flash('error', 'Você não faz parte desta turma!');

                return redirect()->route('catalogo');
            }

            if (strpos(Auth::user()->permissao, "Z") !== false || $turma->user_id == Auth::user()->id)
            {
                if (md5($turma->id . $turma->created_at) != $turma->codigo_convite)
                {
                    $newCodigo = md5($turma->id . $turma->created_at);

                    $turma->update([
                        'codigo_convite' => $newCodigo,
                    ]);
                }
            }

            $alunos = AlunoTurma::with('user')->whereHas('user')->where('turma_id', '=', $idTurma)->paginate($amount);

            $aplicacoes = Aplicacao::all();
            $conteudos = Conteudo::all();

            $transmissoes = CodigoTransmissao::with('aplicacao', 'conteudo')->where([['user_id', '=', $turma->user_id]])->get();

            // dd($turma);

            return view('gestao.turma-mural')->with(compact('aplicacoes', 'conteudos', 'transmissoes', 'turma', 'alunos', 'amount'));
        }

    }

    public function postarMuralTurma($idTurma, Request $request)
    {
        if (Turma::find($idTurma) == null) {
            Redirect::back()->withErrors(['Turma não encontrada!']);
        } else {
            $postagem = PostagemTurma::create([
                'turma_id' => $idTurma,
                'user_id'  => Auth::user()->id,
                'conteudo' => $request->conteudo
            ]);

            if ($request->arquivo != null) {
                $originalName = mb_strtolower($request->arquivo->getClientOriginalName(), 'utf-8');

                $fileExtension = \File::extension($request->arquivo->getClientOriginalName());
                $newFileNameArquivo = md5($request->arquivo->getClientOriginalName() . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;

                $pathArquivo = $request->arquivo->storeAs('uploads/turmas/' . $idTurma . '/arquivos', $newFileNameArquivo, 'local');

                if (!\Storage::disk('local')->put($pathArquivo, file_get_contents($request->arquivo))) {
                    \Session::flash('error', 'Não foi possível fazer upload de seu anexo!');
                } else {
                    $postagem->update([
                        'arquivo' => $newFileNameArquivo
                    ]);
                }
            }

            return Redirect::back()->with('message', 'Postagem enviada com sucesso!');
        }
    }

    public function postExcluirPostagem($idTurma, $idPostagem)
    {
        if (PostagemTurma::find($idPostagem) != null) {
            if (\Storage::disk('local')->has('uploads/turmas/' . $idTurma . '/arquivos/' . PostagemTurma::find($idPostagem)->arquivo)) {
                \Storage::disk('local')->delete('uploads/turmas/' . $idTurma . '/arquivos/' . PostagemTurma::find($idPostagem)->arquivo);
            }

            PostagemTurma::find($idPostagem)->delete();

            return Redirect::back()->with('message', 'Postagem excluída com sucesso!');
        } else {
            return Redirect::back()->withErrors(['Postagem não encontrada!']);
        }
    }

    public function postEnviarComentarioPostagem($idTurma, $idPostagem, Request $request)
    {
        if (Turma::find($idTurma) == null) {
            Redirect::back()->withErrors(['Turma não encontrada!']);
        } else if (PostagemTurma::find($idPostagem) == null) {
            Redirect::back()->withErrors(['Postagem não encontrada!']);
        } else {
            $comentario = ComentarioPostagemTurma::create([
                'postagem_id' => $idPostagem,
                'user_id'     => Auth::user()->id,
                'conteudo'    => $request->conteudo
            ]);

            return Redirect::back()->with('message', 'Comentário enviado com sucesso!');
        }
    }

    public function postExcluirComentarioPostagem($idTurma, $idPostagem, $idComentario)
    {
        if (ComentarioPostagemTurma::find($idPostagem) == null) {
            return Redirect::back()->withErrors(['Comentário não encontrado!']);
        } else {
            ComentarioPostagemTurma::find($idPostagem)->delete();

            return Redirect::back()->with('message', 'Comentário excluído com sucesso!');
        }
    }

    public function getArquivo($idTurma, $idPostagem)
    {
        if (Turma::find($idTurma) == null) {
            Session::flash('error', 'Turma não encontrada!');

            return redirect()->route('catalogo');
        } else {
            if (PostagemTurma::find($idPostagem) == null) {
                Session::flash('error', 'Postagem não encontrada!');

                return redirect()->route('catalogo');
            } else {
                $postagem = PostagemTurma::find($idPostagem);

                if (\Storage::disk('local')->has('uploads/turmas/' . $idTurma . '/arquivos/' . $postagem->arquivo)) {
                    return \Storage::disk('local')->download('uploads/turmas/' . $idTurma . '/arquivos/' . $postagem->arquivo);
                } else {
                    Session::flash('error', 'Arquivo não encontrado!');

                    return redirect()->route('catalogo');
                }
            }
        }
    }

    public function modoPostagem($idTurma, Request $request)
    {
        if (Turma::find($idTurma) == null)
        {
            return response()->json(['error' => 'Turma não encontrada!']);
        }
        else
        {
            if ($request->postagem_aberta === "true" || $request->postagem_aberta === true)
            {
                Turma::find($idTurma)->update([
                    'postagem_aberta' => 1
                ]);
            }
            else
            {
                Turma::find($idTurma)->update([
                    'postagem_aberta' => 0
                ]);
            }

            return response()->json(['success' => 'Modo de postagem da turma modificado com sucesso!']);
        }
    }

    public function gerarConvite($idTurma, Request $request)
    {
        if (Turma::find($idTurma) == null) {
            return response()->json(['error' => 'Turma não encontrada!']);
        } else {
            $turma = Turma::find($idTurma);

            $newCodigo = md5(mb_strtolower($turma->titulo, 'utf-8') . $turma->created_at);

            $turma->update([
                'codigo_convite' => $newCodigo
            ]);

            $link = env("APP_URL") . '/gestao/turma/' . $turma->id . '/mural/convite/' . $newCodigo;

            return response()->json(['success' => 'Convite gerado com sucesso!', 'link' => $link]);
        }
    }

    public function getConvite($idTurma, $idConvite)
    {
        if (Turma::find($idTurma) == null) {
            Session::flash('error', 'Turma não encontrada!');

            return Redirect::route('catalogo');
        } else {
            $turma = Turma::find($idTurma);

            if (md5($turma->id . $turma->created_at) == $idConvite) {
                if (AlunoTurma::where([['turma_id', '=', $turma->id], ['user_id', '=', Auth::user()->id]])->first() == null) {
                    AlunoTurma::create([
                        'turma_id' => $idTurma,
                        'user_id'  => Auth::user()->id
                    ]);
                }

                Session::flash('message', 'Convite de turma aceito com sucesso!');

                return Redirect::route('turma-mural', ['idTurma' => $idTurma]);
            } else {
                Session::flash('error', 'Convite inválido!');

                return Redirect::route('catalogo');
            }
        }
    }
}
