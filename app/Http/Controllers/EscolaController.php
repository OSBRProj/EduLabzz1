<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Redirect;
use Session;

use App\User;
use App\Escola;
use App\Turma;
use App\AlunoTurma;
use App\Aplicacao;
use App\Conteudo;
use App\Metrica;
use App\AvaliacaoConteudo;
use App\AvaliacaoInstrutor;
use App\InteracaoConteudo;
use App\ProgressoConteudo;

use App\LiberacaoAplicacaoEscola;
use App\CodigoAcessoEscola;

use App\PostagemEscola;
use App\ComentarioPostagemEscola;

use App\PostagemGestaoEscola;
use App\ComentarioPostagemGestaoEscola;


use App\CodigoTransmissao;


class EscolaController extends Controller
{

    //
    // Mural de gestao da escola
    //

    public function muralGestaoEscola($escola_id)
    {
        if (Input::get('qt') == null)
        {
            $amount = 10;
        }
        else
        {
            $amount = Input::get('qt');
        }

        if (Escola::find($escola_id) == null)
        {
            return Redirect::back()->withErrors(['Escola não encontrada!']);
        }
        else
        {
            $escola = Escola::with('postagens_gestao', 'postagens_gestao_comentarios')->find($escola_id);

            if (strpos(Auth::user()->permissao, "G") === false && strpos(Auth::user()->permissao, "Z") === false && $escola->user_id != Auth::user()->id && Auth::user()->escola_id != $escola_id)
            {
                Session::flash('error', 'Você não faz parte desta escola!');

                return redirect()->route('catalogo');
            }

            $usuarios = User::where([['escola_id', '=', $escola_id], ['permissao', '!=', 'A']])->paginate($amount);

            // dd($escola);

            return view('gestao.gestao-escola-mural')->with(compact('escola', 'usuarios', 'amount'));
        }

    }

    public function postarMuralGestaoEscola($escola_id, Request $request)
    {
        if (Escola::find($escola_id) == null) {
            Redirect::back()->withErrors(['Escola não encontrada!']);
        } else {
            $postagem = PostagemGestaoEscola::create([
                'escola_id' => $escola_id,
                'user_id'  => Auth::user()->id,
                'conteudo' => $request->conteudo
            ]);

            if ($request->arquivo != null) {
                $originalName = mb_strtolower($request->arquivo->getClientOriginalName(), 'utf-8');

                $fileExtension = \File::extension($request->arquivo->getClientOriginalName());
                $newFileNameArquivo = md5($request->arquivo->getClientOriginalName() . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;

                $pathArquivo = $request->arquivo->storeAs('uploads/escolas/' . $escola_id . '/arquivos', $newFileNameArquivo, 'local');

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

    public function postExcluirPostagemGestao($escola_id, $idPostagem)
    {
        if (PostagemGestaoEscola::find($idPostagem) != null) {
            if (\Storage::disk('local')->has('uploads/escolas/' . $escola_id . '/arquivos/' . PostagemGestaoEscola::find($idPostagem)->arquivo)) {
                \Storage::disk('local')->delete('uploads/escolas/' . $escola_id . '/arquivos/' . PostagemGestaoEscola::find($idPostagem)->arquivo);
            }

            PostagemGestaoEscola::find($idPostagem)->delete();

            return Redirect::back()->with('message', 'Postagem excluída com sucesso!');
        } else {
            return Redirect::back()->withErrors(['Postagem não encontrada!']);
        }
    }

    public function postEnviarComentarioPostagemGestao($escola_id, $idPostagem, Request $request)
    {
        if (Escola::find($escola_id) == null) {
            Redirect::back()->withErrors(['Escola não encontrada!']);
        } else if (PostagemGestaoEscola::find($idPostagem) == null) {
            Redirect::back()->withErrors(['Postagem não encontrada!']);
        } else {
            $comentario = ComentarioPostagemGestaoEscola::create([
                'postagem_id' => $idPostagem,
                'user_id'     => Auth::user()->id,
                'conteudo'    => $request->conteudo
            ]);

            return Redirect::back()->with('message', 'Comentário enviado com sucesso!');
        }
    }

    public function postExcluirComentarioPostagemGestao($escola_id, $idPostagem, $idComentario)
    {
        if (ComentarioPostagemGestaoEscola::find($idPostagem) == null) {
            return Redirect::back()->withErrors(['Comentário não encontrado!']);
        } else {
            ComentarioPostagemGestaoEscola::find($idPostagem)->delete();

            return Redirect::back()->with('message', 'Comentário excluído com sucesso!');
        }
    }

    public function getArquivoGestao($escola_id, $postagem_id)
    {
        if (Escola::find($escola_id) == null) {
            Session::flash('error', 'Escola não encontrada!');

            return redirect()->route('catalogo');
        } else {
            if (PostagemGestaoEscola::find($postagem_id) == null) {
                Session::flash('error', 'Postagem não encontrada!');

                return redirect()->route('catalogo');
            } else {
                $postagem = PostagemGestaoEscola::find($postagem_id);

                if (\Storage::disk('local')->has('uploads/escolas/' . $escola_id . '/arquivos/' . $postagem->arquivo)) {
                    return \Storage::disk('local')->download('uploads/escolas/' . $escola_id . '/arquivos/' . $postagem->arquivo);
                } else {
                    Session::flash('error', 'Arquivo não encontrado!');

                    return redirect()->route('catalogo');
                }
            }
        }
    }

    //
    // Mural da escola para alunos
    //

    public function muralEscola($escola_id)
    {
        if (Input::get('qt') == null)
        {
            $amount = 10;
        }
        else
        {
            $amount = Input::get('qt');
        }

        if (Escola::find($escola_id) == null)
        {
            return Redirect::back()->withErrors(['Escola não encontrada!']);
        }
        else
        {
            $escola = Escola::with('postagens_comentarios')->find($escola_id);

            if (strpos(Auth::user()->permissao, "G") === false && strpos(Auth::user()->permissao, "Z") === false && $escola->user_id != Auth::user()->id && Auth::user()->escola_id != $escola_id)
            {
                Session::flash('error', 'Você não faz parte desta escola!');

                return redirect()->route('catalogo');
            }

            $alunos = User::where('escola_id', '=', $escola_id)->paginate($amount);

            $aplicacoes = Aplicacao::all();
            $conteudos = Conteudo::all();

            $transmissoes = CodigoTransmissao::with('aplicacao', 'conteudo')->where([['user_id', '=', $escola->user_id]])->get();

            // dd($escola);

            return view('gestao.escola-mural')->with(compact('aplicacoes', 'conteudos', 'transmissoes', 'escola', 'alunos', 'amount'));
        }

    }

    public function postarMuralEscola($escola_id, Request $request)
    {
        if (Escola::find($escola_id) == null) {
            Redirect::back()->withErrors(['Escola não encontrada!']);
        } else {
            $postagem = PostagemEscola::create([
                'escola_id' => $escola_id,
                'user_id'  => Auth::user()->id,
                'conteudo' => $request->conteudo
            ]);

            if ($request->arquivo != null) {
                $originalName = mb_strtolower($request->arquivo->getClientOriginalName(), 'utf-8');

                $fileExtension = \File::extension($request->arquivo->getClientOriginalName());
                $newFileNameArquivo = md5($request->arquivo->getClientOriginalName() . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;

                $pathArquivo = $request->arquivo->storeAs('uploads/escolas/' . $escola_id . '/arquivos', $newFileNameArquivo, 'local');

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

    public function postExcluirPostagem($escola_id, $idPostagem)
    {
        if (PostagemEscola::find($idPostagem) != null) {
            if (\Storage::disk('local')->has('uploads/escolas/' . $escola_id . '/arquivos/' . PostagemEscola::find($idPostagem)->arquivo)) {
                \Storage::disk('local')->delete('uploads/escolas/' . $escola_id . '/arquivos/' . PostagemEscola::find($idPostagem)->arquivo);
            }

            PostagemEscola::find($idPostagem)->delete();

            return Redirect::back()->with('message', 'Postagem excluída com sucesso!');
        } else {
            return Redirect::back()->withErrors(['Postagem não encontrada!']);
        }
    }

    public function postEnviarComentarioPostagem($escola_id, $idPostagem, Request $request)
    {
        if (Escola::find($escola_id) == null) {
            Redirect::back()->withErrors(['Escola não encontrada!']);
        } else if (PostagemEscola::find($idPostagem) == null) {
            Redirect::back()->withErrors(['Postagem não encontrada!']);
        } else {
            $comentario = ComentarioPostagemEscola::create([
                'postagem_id' => $idPostagem,
                'user_id'     => Auth::user()->id,
                'conteudo'    => $request->conteudo
            ]);

            return Redirect::back()->with('message', 'Comentário enviado com sucesso!');
        }
    }

    public function postExcluirComentarioPostagem($escola_id, $idPostagem, $idComentario)
    {
        if (ComentarioPostagemEscola::find($idPostagem) == null) {
            return Redirect::back()->withErrors(['Comentário não encontrado!']);
        } else {
            ComentarioPostagemEscola::find($idPostagem)->delete();

            return Redirect::back()->with('message', 'Comentário excluído com sucesso!');
        }
    }

    public function getArquivo($escola_id, $postagem_id)
    {
        if (Escola::find($escola_id) == null) {
            Session::flash('error', 'Escola não encontrada!');

            return redirect()->route('catalogo');
        } else {
            if (PostagemEscola::find($postagem_id) == null) {
                Session::flash('error', 'Postagem não encontrada!');

                return redirect()->route('catalogo');
            } else {
                $postagem = PostagemEscola::find($postagem_id);

                if (\Storage::disk('local')->has('uploads/escolas/' . $escola_id . '/arquivos/' . $postagem->arquivo)) {
                    return \Storage::disk('local')->download('uploads/escolas/' . $escola_id . '/arquivos/' . $postagem->arquivo);
                } else {
                    Session::flash('error', 'Arquivo não encontrado!');

                    return redirect()->route('catalogo');
                }
            }
        }
    }

    public function modoPostagem($escola_id, Request $request)
    {
        if (Escola::find($escola_id) == null)
        {
            return response()->json(['error' => 'Escola não encontrada!']);
        }
        else
        {
            if ($request->postagem_aberta === "true" || $request->postagem_aberta === true)
            {
                Escola::find($escola_id)->update([
                    'postagem_aberta' => 1
                ]);
            }
            else
            {
                Escola::find($escola_id)->update([
                    'postagem_aberta' => 0
                ]);
            }



            return response()->json(['success' => 'Modo de postagem da escola modificado com sucesso!']);
        }
    }

    // Gestao de escolas

    public function escolas()
    {
        if(Input::get('qt') == null)
            $amount = 10;
        else
            $amount = Input::get('qt');

        if(Input::get('ordem') == null)
            $ordem = "recentes";
        else
            $ordem = Input::get('ordem');

        if(Input::get('categoria') == null)
            $categoria = "";
        elseif(Input::get('categoria') == "geral")
            $categoria = "";
        else
            $categoria = Input::get('categoria');

        if($categoria != null)
        {
            if(Categoria::where('titulo', '=', $categoria)->first() != null)
            {
                $categoria = Categoria::where('titulo', '=', $categoria)->first()->id;
            }
        }

        $escolas = Escola::paginate($amount);

        foreach ($escolas as $escola)
        {
            $escola->qt_alunos = User::where([['permissao', '=', 'A'], ['escola_id', '=', $escola->id]])->count();
        }

        return view('gestao.crm.escolas')->with( compact('escolas', 'amount', 'ordem') );
    }

    public function criarEscola()
    {
        return view('criar-escola');
    }

    public function postCriarEscola(Request $request)
    {
        // dd($request);

        if($request->descricao == null)
        {
            $request->descricao = "";
        }

        $escola = Escola::create([
            'user_id' => Auth::user()->id,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao
        ]);

        if($request->capa !=null)
        {
            $fileExtension = \File::extension($request->capa->getClientOriginalName());
            $newFileNameCapa =  md5( $request->capa->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

            $pathCapa = $request->capa->storeAs('escolas/capas', $newFileNameCapa, 'public_uploads');

            if(!\Storage::disk('public_uploads')->put($pathCapa, file_get_contents($request->capa)) )
            {
                \Session::flash('error', 'Ops! Não foi possivel enviar a capa.');
            }
            else
            {
                $escola->capa = $newFileNameCapa;

                $escola->save();
            }
        }

        Session::flash("message", 'Escola criada com sucesso!');

        return redirect()->route('gestao.escolas');
    }

    public function getEscola($escola_id)
    {
        $escola = Escola::find($escola_id);

        if($escola != null)
        {
            return response()->json(['success'=> 'Escola encontrada.', 'escola' => $escola]);
        }
        else
        {
            return response()->json(['error' => 'Escola não encontrada!']);
        }
    }

    public function postSalvarEscola(Request $request)
    {
        if(Escola::where([['id', '=', $request->escola_id]])->exists() != false)
        {
            $escola = Escola::where([['id', '=', $request->escola_id]])->first();

            $escola->update([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'limite_alunos' => $request->limite_alunos,
                'nome_completo' => $request->nome_completo,
                'cnpj' => $request->cnpj,
                'nome_responsavel' => $request->nome_responsavel,
                'email_responsavel' => $request->email_responsavel,
                'telefone_responsavel' => $request->telefone_responsavel,
            ]);

            Session::flash("message", 'Escola atualizada com sucesso!');
        }
        else
        {
            return redirect()->back()->withErrors("Escola não encontrada!");
        }

        return redirect()->back();
    }

    public function postExcluirEscola(Request $request)
    {
        if(Escola::find($request->idEscola) != null)
        {
            if(\Storage::disk('public_uploads')->has('escolas/capas/' . Escola::find($request->idEscola)->capa))
            {
                \Storage::disk('public_uploads')->delete('escolas/capas/' . Escola::find($request->idEscola)->capa);
            }

            Escola::find($request->idEscola)->delete();

            Session::flash("message", 'Escola excluída com sucesso!');
        }
        else
        {
            return redirect()->back()->withErrors("Escola não encontrada!");
        }

        return redirect()->back();
    }

    public function painelEscola($escola_id)
    {
        $escola = Escola::find($escola_id);

        $userId = Auth::user()->id;

        if(Input::get('qtAlunos') == null)
            $amountAlunos = 10;
        else
            $amountAlunos = Input::get('qtAlunos');

        if(Input::get('qtProfessores') == null)
            $amountProfessores = 10;
        else
            $amountProfessores = Input::get('qtProfessores');

        if(Input::get('qtTurmas') == null)
            $amountTurmas = 10;
        else
            $amountTurmas = Input::get('qtTurmas');

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;


        //Relatorios gerais

        //
        // Carregar alunos da escola
        //
        $alunos = User::query();
        $alunos->when($tem_pesquisa, function ($query) {
            return $query
            ->where('name', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('email', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $alunos = $alunos
        ->with('turmas_aluno')
        ->where([['escola_id', '=', $escola_id], ['permissao', '=', 'A']])
        ->paginate($amountAlunos);

        //
        // Carregar professores da escola
        //
        $professores = User::query();
        $professores->when($tem_pesquisa, function ($query) {
            return $query
            ->where('name', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('email', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $professores = $professores
        ->with('turmas_instrutor')
        ->where([['escola_id', '=', $escola_id], ['permissao', '=', 'P']])
        ->paginate($amountProfessores);

        //
        // Carregar gestores da escola
        //
        $gestores = User::query();
        $gestores->when($tem_pesquisa, function ($query) {
            return $query
            ->where('name', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('email', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $gestores = $gestores
        ->where([['escola_id', '=', $escola_id], ['permissao', '=', 'G']])
        ->get();

        foreach($alunos as $aluno)
        {
            if(ProgressoConteudo::where('user_id', '=', $aluno->id)->count() > 0)
                $aluno->desempenho = ProgressoConteudo::where('user_id', '=', $aluno->id)->avg('progresso');
            else
                $aluno->desempenho = 0;
        }

        foreach ($professores as $professor)
        {
            if(AvaliacaoInstrutor::where('instrutor_id', '=', $professor->id)->count() > 0)
            {
                $professor->avaliacao = AvaliacaoInstrutor::where('instrutor_id', '=', $professor->id)->avg('avaliacao');
            }
            else
            {
                $professor->avaliacao = 5;
            }
        }

        $turmas = Turma::with('professor')->whereHas('professor', function($q) use ($escola_id) {
            $q->where('escola_id', '=', $escola_id);
        })->paginate($amountTurmas);

        foreach($turmas as $turma)
        {
            $turma->qt_alunos = AlunoTurma::where([['turma_id', '=', $turma->id]])->count();
        }

        $totalAlunos = count($alunos);
        $totalProfessores = count($professores);
        $totalGestores = count($gestores);
        $totalTurmas = count($turmas);

        $mediaAlunosConectados = [0, 0, 0, 0, 0];

        $nivelAprendizado = [0, 0, 0, 0, 0, 0];

        foreach (User::all() as $user)
        {
            $user->acessos = Metrica::
            where([['titulo', '=', 'Acesso na plataforma'], ['user_id', '=', $user->id]])
            ->whereHas('user', function ($q) use ($escola_id) {
                $q->where('escola_id', '=', $escola_id);
            })
            ->count();

            if($user->acessos >= 31)
            {
                $mediaAlunosConectados[0] ++;
            }
            elseif($user->acessos >= 16 && $user->acessos <= 30)
            {
                $mediaAlunosConectados[1] ++;
            }
            elseif($user->acessos >= 6 && $user->acessos <= 15)
            {
                $mediaAlunosConectados[2] ++;
            }
            elseif($user->acessos >= 1 && $user->acessos <= 5)
            {
                $mediaAlunosConectados[3] ++;
            }
            else
            {
                $mediaAlunosConectados[4] ++;
            }

            $totalAvaliacoes = AvaliacaoConteudo::
            where([['user_id', '=', $user->id]])
            ->whereHas('user', function ($q) use ($escola_id) {
                $q->where('escola_id', '=', $escola_id);
            })
            ->count();

            $totalAvaliacoesPositivas = AvaliacaoConteudo::
            where([['user_id', '=', $user->id], ['avaliacao', '=', 1]])
            ->whereHas('user', function ($q) use ($escola_id) {
                $q->where('escola_id', '=', $escola_id);
            })
            ->count();

            if($totalAvaliacoes == 0)
            {
                $nivelAprendizado[5] ++;
            }
            else
            {
                $percentualAprendizagem = ($totalAvaliacoesPositivas * 100) / $totalAvaliacoes;

                if($percentualAprendizagem >= 80)
                {
                    $nivelAprendizado[0] ++;
                }
                elseif($percentualAprendizagem >= 60 && $percentualAprendizagem <= 79)
                {
                    $nivelAprendizado[1] ++;
                }
                elseif($percentualAprendizagem >= 40 && $percentualAprendizagem <= 59)
                {
                    $nivelAprendizado[2] ++;
                }
                elseif($percentualAprendizagem >= 20 && $percentualAprendizagem <= 39)
                {
                    $nivelAprendizado[3] ++;
                }
                else//if($percentualAprendizagem >= 0 && $percentualAprendizagem <= 19)
                {
                    $nivelAprendizado[4] ++;
                }
            }
        }

        $aplicacoes = Aplicacao::with('progressos_user.user')
        ->whereHas('user', function ($q) use ($escola_id) {
            $q->where('escola_id', '=', $escola_id);
        })
        ->get();

        $conteudos = Conteudo::with('progressos_user.user')
        ->whereHas('user', function ($q) use ($escola_id) {
            $q->where('escola_id', '=', $escola_id);
        })
        ->get();

        $videos = $conteudos->filter(function ($c) { return $c->tipo == 3; });
        $slides = $conteudos->filter(function ($c) { return ($c->tipo == 4 && (strpos($c->conteudo, ".ppt") !== false || strpos($c->conteudo, ".pptx") !== false)); });
        $documentos = $conteudos->filter(function ($c) { return $c->tipo == 1 || ($c->tipo == 4 && (strpos($c->conteudo, ".ppt") == false && strpos($c->conteudo, ".pptx") == false)); });
        $apostilas = $conteudos->filter(function ($c) { return $c->tipo == 11; });

        // dd($aplicacoes);
        // dd($conteudos);

        $totalAplicacoes = count($aplicacoes);
        $totalConteudos = count($conteudos);

        $mediaAtividadesCompletas = 0;
        $somatoria = 0;
        $total = 0;

        $participativos = 0;

        foreach ($aplicacoes as $aplicacao)
        {
            foreach ($aplicacao->progressos_user as $progresso)
            {
                if($progresso->user['escola_id'] == $escola_id)
                {
                    if($progresso->progresso > 0)
                        $participativos ++;

                    if($progresso->progresso > 100)
                        $progresso->progresso = 100;

                    $somatoria ++;
                    $total += $progresso->progresso;
                }
            }
        }

        foreach ($conteudos as $conteudo)
        {
            foreach ($conteudo->progressos_user as $progresso)
            {
                if($progresso->user['escola_id'] == $escola_id)
                {
                    if($progresso->progresso > 0)
                        $participativos ++;

                    if($progresso->progresso > 100)
                        $progresso->progresso = 100;

                    $somatoria ++;
                    $total += $progresso->progresso;
                }
            }
        }

        $totalProgressos = ProgressoConteudo::count();

        if($somatoria > 0)
        {
            $mediaAtividadesCompletas = number_format($total / $somatoria, 0);

            if($participativos > 0)
            {
                $participacao = number_format( ($participativos * 100) / $participativos, 0);
            }
            else
            {
                $participacao = 0;
            }
        }
        else
        {
            $mediaAtividadesCompletas = 0;

            $participacao = 0;
        }

        // Liberação de aplicações para escola

        $liberacaoAplicacoesEscola = LiberacaoAplicacaoEscola::where('escola_id', $escola->id)->whereHas('aplicacao')->get();

        foreach ($liberacaoAplicacoesEscola as $key => $liberacao)
        {
            $liberacao->titulo = ucfirst(Aplicacao::where('id', $liberacao->aplicacao_id)->first()->titulo);
        }

        $codigosAcesso = CodigoAcessoEscola::where('escola_id', $escola->id)->get();

        return view('gestao.escola-painel')->with(compact('escola',
        'codigosAcesso', 'liberacaoAplicacoesEscola',
        'totalGestores', 'totalProfessores', 'totalProgressos',
        'mediaAtividadesCompletas', 'participacao', 'mediaAlunosConectados', 'nivelAprendizado',
        'aplicacoes', 'conteudos', 'videos', 'slides', 'documentos',
        'alunos', 'totalAlunos', 'amountAlunos',
        'turmas', 'totalTurmas', 'amountTurmas',
        'professores', 'amountProfessores', 'gestores'));
    }

    public function editarEscola($escola_id)
    {
        $escola = Escola::find($escola_id);

        if($escola == null)
        {
            return redirect()->route('gestao.escolas');
        }

        $escola->caracteristicas = json_decode($escola->caracteristicas);

        return view('gestao.editar-escola')->with( compact('escola') );
    }

}
