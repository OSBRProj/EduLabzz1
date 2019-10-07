<?php

namespace App\Http\Controllers;

use App\Entities\Historico\Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\Escola;
use App\Categoria;
use App\Conteudo;
use App\ConteudoAula;
use App\ProgressoConteudo;
use App\InteracaoConteudo;
use App\AvaliacaoConteudo;
use App\AvaliacaoInstrutor;
use App\Metrica;

class ConteudoController extends Controller
{
    function playConteudo($idConteudo, Request $request)
    {
        if (Conteudo::find($idConteudo))
        {
            $conteudo = Conteudo::find($idConteudo);
        }
        else
        {
            return Redirect::back()->withErrors(['Conteúdo não encontrado!']);
        }


        // Histórico
        if (Historico::where([
                ['user_id', Auth::user()->id],
                ['referencia_id', $idConteudo],
                ['tipo', 2],
                ['created_at', '>', (Carbon::now()->subMinutes(15))]])
                ->exists() == false)
                {
            Historico::create([
                'user_id'       => Auth::user()->id,
                'referencia_id' => $idConteudo,
                'tipo'          => 2
            ]);
        }

        if ($conteudo->status != 1)
        {
            if (Auth::check() ? (strtolower(Auth::user()->permissao) != "z" && $conteudo->user_id != Auth::user()->id) : true)
            {
                return Redirect::back()->withErrors(['Conteúdo não encontrado!']);
            }
            else
            {
                Session::flash('previewMode', true);
            }
        }

        if ($conteudo->tipo == 2) {
            if (strpos($conteudo->conteudo, "soundcloud.com") !== false) {
                $conteudo->conteudo = '<iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=' . $conteudo->conteudo . '&color=%236766a6&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>';
            } elseif (strpos($conteudo->conteudo, "http") !== false || strpos($conteudo->conteudo, "www") !== false) {
                $conteudo->conteudo = '<audio controls style="width: 100%;">
                    <source src="' . $conteudo->conteudo . '" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>';
            } else {
                $conteudo->conteudo = '<audio controls style="width: 100%;">
                    <source src="' . route('conteudo.play.get-arquivo', ['idConteudo' => $idConteudo]) . '" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>';
            }
        } else if ($conteudo->tipo == 3) {
            if (strpos($conteudo->conteudo, "youtube") !== false || strpos($conteudo->conteudo, "youtu.be") !== false) {
                if (strpos($conteudo->conteudo, "youtu.be") !== false) {
                    $conteudo->conteudo = str_replace("youtu.be", "youtube.com", $conteudo->conteudo);
                }

                $conteudo->conteudo = str_replace("/watch?v=", "/embed/", $conteudo->conteudo);

                if (strpos($conteudo->conteudo, "&") !== false) {
                    $conteudo->conteudo = substr($conteudo->conteudo, 0, strpos($conteudo->conteudo, "&"));
                }

                $conteudo->conteudo = '<iframe src="' . $conteudo->conteudo . '" style="width: 100%; height: 41vw;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>';

            } elseif (strpos($conteudo->conteudo, "vimeo") !== false) {
                if (strpos($conteudo->conteudo, "player.vimeo.com") === false)
                    $conteudo->conteudo = str_replace("vimeo.com/", "player.vimeo.com/video/", $conteudo->conteudo);

                $conteudo->conteudo = '<iframe src="' . $conteudo->conteudo . '" style="width: 100%; height: 41vw;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                </iframe>';
            } else {
                $conteudo->conteudo = '<video controls style="width: 100%; height: 41vw;">
                    <source src="' . route('conteudo.play.get-arquivo', ['idConteudo' => $idConteudo]) . '" type="video/mp4">
                    Your browser does not support the audio element.
                </video>';
            }
        }
        else if ($conteudo->tipo == 4)
        {

            if(strpos($conteudo->conteudo, "http") === false && strpos($conteudo->conteudo, "www") === false)
            {
                $url_conteudo = route('conteudo.play.get-arquivo', ['idConteudo' => $idConteudo]);
            }
            else
            {
                $url_conteudo = $conteudo->conteudo;
            }

            if (strpos($conteudo->conteudo, ".ppt") !== false || strpos($conteudo->conteudo, ".pptx") !== false)
            {
                $conteudo->conteudo = '<iframe src="https://view.officeapps.live.com/op/view.aspx?src=' . $url_conteudo . '" style="width: 100%; height: 41vw;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>';
            }
            elseif (strpos($conteudo->conteudo, ".html") !== false)
            {
                $conteudo->conteudo = '<iframe src="' . $url_conteudo . '" style="width: 100%; height: 41vw;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>';
            }
            elseif (strpos($conteudo->conteudo, "drive.google.com/file") !== false)
            {
                if (strpos($conteudo->conteudo, "/view") !== false)
                {
                    $url_conteudo = str_replace("/view", "/preview", $url_conteudo);
                }

                $conteudo->conteudo = '<iframe src="' . $url_conteudo . '" style="width: 100%; height: 41vw;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>';
            }
            else
            {
                $conteudo->conteudo = '<object data="' . $url_conteudo . '" type="application/pdf" style="width: 100%; height: 41vw;">
                </object>';
            }

        }
        else if ($conteudo->tipo == 11)
        {
            $url_apostila = env("APP_LOCAL") . '/uploads/apostilas/' . $conteudo->id;

            $conteudo->conteudo = '<iframe src="' . env("APP_LOCAL") . '/leitor_apostila/' . $conteudo->id . '?conteudo_id=' . $conteudo->id . '&url=' . $url_apostila . '" style="width: 100%; height: 115vh;" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>';
        }

        $conteudo->qtAvaliacoesPositivas = AvaliacaoConteudo::where([['avaliacao', '=', '1'], ['conteudo_id', '=', $idConteudo]])->count();

        $conteudo->qtAvaliacoesNegativas = AvaliacaoConteudo::where([['avaliacao', '=', '0'], ['conteudo_id', '=', $idConteudo]])->count();

        $conteudo->minhaAvaliacao = AvaliacaoConteudo::where([['user_id', '=', Auth::user()->id], ['conteudo_id', '=', $idConteudo]])->first();

        if (!ProgressoConteudo::where([['conteudo_id', '=', $idConteudo], ['tipo', '=', 2], ['user_id', '=', Auth::user()->id]])->exists()) {
            ProgressoConteudo::create([
                'conteudo_id' => $idConteudo,
                'tipo'        => 2,
                'user_id'     => Auth::user()->id
            ]);
        }

        return view('play.conteudo')->with(compact('conteudo'));
    }

    function playGetArquivo($idConteudo)
    {
        if (Conteudo::where([['id', '=', $idConteudo]])->first() != null)
        {
            $conteudo = Conteudo::where([['id', '=', $idConteudo]])->first();

            if (strpos($conteudo->conteudo, ".ppt") === false && strpos($conteudo->conteudo, ".html") === false)
            {
                if (!Auth::check())
                {
                    return response()->json(['error' => 'Usuário não autenticado!']);
                }
            }

            $idCurso = ConteudoAula::where([['conteudo_id', '=', $idConteudo]])->first() != null ? ConteudoAula::where([['conteudo_id', '=', $idConteudo]])->first()->curso_id : null;

            // dd($idCurso);

            if (\Storage::disk('local')->has('uploads/conteudos/' . $conteudo->conteudo))
            {
                return \Storage::disk('local')->response('uploads/conteudos/' . $conteudo->conteudo);
            }
            else if(\Storage::disk('local')->has('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudo->conteudo) && $idCurso != null)
            {
                $filePath = 'uploads/cursos/' . $idCurso . '/arquivos/' . $conteudo->conteudo;

                return \Storage::disk('local')->response($filePath);
            }
            else
            {
                return $conteudo->conteudo;
            }



        }
        else
        {
            return response()->view('errors.404');
        }
    }

    public function postEnviarAvaliacaoConteudo($idConteudo, Request $request)
    {
        if (Conteudo::where([['id', '=', $idConteudo]])->first() != null) {
            AvaliacaoConteudo::updateOrCreate(
                [
                    'user_id'     => Auth::user()->id,
                    'conteudo_id' => $idConteudo,
                ],
                ['avaliacao' => $request->avaliacao]
            );

            return response()->json(['success' => 'Avaliação enviada com sucesso!']);
        } else {
            return response()->json(['error' => 'Conteúdo não encontrado!']);
        }
    }

    public function postEnviarInteracaoConteudo($idConteudo, Request $request)
    {
        if (Conteudo::where([['id', '=', $idConteudo]])->first() != null) {
            InteracaoConteudo::create([
                'conteudo_id' => $idConteudo,
                'user_id'     => Auth::user()->id,
                'tipo'        => $request->tipo,
                'inicio'      => $request->inicio
            ]);

            return response()->json(['success' => 'Interação enviada com sucesso!']);
        } else {
            return response()->json(['error' => 'Conteúdo não encontrado!']);
        }
    }

    public function postEnviarAvaliacaoProfessor($idInstrutor, Request $request)
    {
        if ($request->comentario == null) {
            $request->comentario = '';
        }

        AvaliacaoInstrutor::updateOrCreate(
            [
                'user_id'      => Auth::user()->id,
                'instrutor_id' => $idInstrutor
            ],
            ['avaliacao' => $request->avaliacao, 'descricao' => $request->comentario]
        );

        return response()->json(['success' => 'Avaliação enviada com sucesso!']);
    }

}
