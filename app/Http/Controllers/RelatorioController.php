<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\Escola;
use App\User;
use App\Turma;
use App\AlunoTurma;
use App\PostagemTurma;
use App\ComentarioPostagemTurma;
use App\DuvidaProfessor;
use App\Categoria;
use App\Curso;
use App\Aula;
use App\Aplicacao;
use App\Conteudo;
use App\ProgressoConteudo;
use App\InteracaoConteudo;
use App\AvaliacaoInstrutor;
use App\AvaliacaoConteudo;
use App\Metrica;

use App\ConteudoCompleto;
use App\AvaliacaoCurso;
use App\AvaliacaoEscola;
use App\Matricula;

class RelatorioController extends Controller
{
    public function index()
    {
        if(strtoupper(Auth::user()->permissao) == "G")
        {
            $escola = Escola::where('user_id', '=', Auth::user()->id)->first();
        }

        if(!isset($escola))
        {
            $escola = Escola::find(1);
        }
        elseif($escola == null)
        {
            $escola = Escola::find(1);
        }

        $userId = Auth::user()->id;

        $escolas = null;

        if(strtoupper(Auth::user()->permissao) == "Z")
        {
            $escolas = Escola::all();

            // Alunos
            $alunos = User::with('progressos', 'badges_user')->where([['permissao', '=', 'A']])->get();

            //Relatorios gerais
            $totalEscolas = Escola::count();

            $totalGestores = User::where('permissao', '=', 'G')->count();

            $totalProfessores = User::where('permissao', '=', 'P')->count();

            $totalTurmas = Turma::count();

            $totalAlunos = User::where('permissao', '=', 'A')->count();
        }
        else if(strtoupper(Auth::user()->permissao) == "G")
        {
            $alunos = User::with('progressos', 'badges_user')->where([['permissao', '=', 'A'], ['escola_id', '=', Auth::user()->escola_id]])->get();

            //Relatorios gerais
            $totalEscolas = Escola::count();

            $totalGestores = User::where([['permissao', '=', 'G'], ['escola_id', '=', Auth::user()->escola_id]])->count();

            $totalProfessores = User::where([['permissao', '=', 'P'], ['escola_id', '=', Auth::user()->escola_id]])->count();

            $totalTurmas = Turma::where([['escola_id', '=', Auth::user()->escola_id]])->count();

            $totalAlunos = User::where([['permissao', '=', 'A'], ['escola_id', '=', Auth::user()->escola_id]])->count();
        }
        else
        {
            $turmasId = Turma::where('user_id', '=', Auth::user()->id)->pluck('id');

            $alunos = User::with('progressos', 'badges_user')->where([['permissao', '=', 'A'], ['escola_id', '=', Auth::user()->escola_id]])
            ->whereHas('turmas_aluno', function ($query) use ($turmasId) {
                $query->whereIn('turma_id', $turmasId);
            })->get();

            //Relatorios gerais
            $totalEscolas = Escola::count();

            $totalGestores = User::where([['permissao', '=', 'G'], ['escola_id', '=', Auth::user()->escola_id]])->count();

            $totalProfessores = User::where([['permissao', '=', 'P'], ['escola_id', '=', Auth::user()->escola_id]])->count();

            $totalTurmas = Turma::where([['escola_id', '=', Auth::user()->escola_id]])->count();

            $totalAlunos = User::where([['permissao', '=', 'A'], ['escola_id', '=', Auth::user()->escola_id]])->count();
        }

        $mediaAlunosConectados = [0, 0, 0, 0, 0];

        $nivelAprendizado = [0, 0, 0, 0, 0, 0];

        foreach ($alunos as $user)
        {
            $user->acessos = Metrica::where([['titulo', '=', 'Acesso na plataforma'], ['user_id', '=', $user->id]])->count();

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

            $totalConteudosCompletos = ProgressoConteudo::where([['user_id', '=', $user->id], ['progresso', '>=', 100]])->count();
            $totalAvaliacoes = AvaliacaoConteudo::where([['user_id', '=', $user->id]])->count();
            $totalAvaliacoesPositivas = AvaliacaoConteudo::where([['user_id', '=', $user->id], ['avaliacao', '=', 1]])->count();

            if($totalConteudosCompletos == 0 || $totalAvaliacoes == 0)
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

            // foreach (ConteudoCompleto::where('user_id', '=', $user->id)->get() as $conteudo)
            // {
            //     $avaliacao = AvaliacaoConteudo::where([['user_id', '=', $user->id], ['curso_id', '=', $conteudo->curso_id], ['aula_id', '=', $conteudo->aula_id], ['conteudo_id', '=', $conteudo->id]])->get();

            //     if($avaliacao != null)
            //     {
            //         $
            //     }
            // }
        }

        // dd($nivelAprendizado);

        // Cursos

        if(strtolower(Auth::user()->permissao) == "z")
        {
            $totalCursos = Curso::count();
        }
        else
        {
            $totalCursos = Curso::where('user_id', '=', $userId)->count();
        }

        //Relatorios cursos
        if(strtolower(Auth::user()->permissao) == "z")
        {
            $cursos = Curso::with('matriculas')->get();

            $totalMatriculados = Matricula::whereHas('curso')->whereHas('user')->count();
        }
        else
        {
            $cursos = Curso::with('matriculas')->where('user_id', '=', $userId)->get();

            $totalMatriculados = Matricula::whereHas('user')->whereHas('curso', function($item) use($userId)
            {
                $item->where('user_id', '=', $userId);
            })->count();
        }

        $mediaAtividadesCompletas = 0;
        $somatoria = 0;
        $total = 0;

        $participativos = 0;

        foreach ($cursos as $curso)
        {
            foreach ($curso->matriculas as $matricula)
            {
                $matricula->user = User::find($matricula->user_id);

                $total_conteudos = Conteudo::whereHas('conteudos_aula', function ($query) use ($matricula) {
                    $query->where([['curso_id', '=', $matricula->curso_id], ['obrigatorio', '=', '1']]);
                })->count();

                if($total_conteudos > 0)
                {
                    $matricula->progresso = number_format((ConteudoCompleto::where([['user_id', '=', $matricula->user_id], ['curso_id', '=', $matricula->curso_id]])->count() * 100) / $total_conteudos, 2);
                }
                else
                {
                    $matricula->progresso = 0;
                }

                if($matricula->progresso > 0)
                    $participativos ++;

                if($matricula->progresso > 100)
                    $matricula->progresso = 100;

                $somatoria ++;
                $total += $matricula->progresso;
            }
        }

        // Conteudos

        if(strtoupper(Auth::user()->permissao) == "Z")
        {
            $totalConteudos = Conteudo::count();
        }
        elseif(strtoupper(Auth::user()->permissao) == "G")
        {
            $totalConteudos = Conteudo::where('user_id', '=', $userId)
                ->orWhereHas('user', function ($query) {
                    $query->where('escola_id', '=', Auth::user()->escola_id);
                })->count();
        }
        else
        {
            $totalConteudos = Conteudo::where('user_id', '=', $userId)->count();
        }

        //Relatorios conteudos
        if(strtoupper(Auth::user()->permissao) == "Z")
        {
            $conteudos = Conteudo::all();

            // $totalMatriculados = Matricula::count();
        }
        elseif(strtoupper(Auth::user()->permissao) == "G")
        {
            $conteudos = Conteudo::where('user_id', '=', $userId)
                ->orWhereHas('user', function ($query) {
                    $query->where('escola_id', '=', Auth::user()->escola_id);
                })->get();
        }
        else
        {
            $conteudos = Conteudo::where('user_id', '=', $userId)->get();

            // $totalMatriculados = Matricula::whereHas('curso', function($item) use($userId)
            // {
            //     $item->where('user_id', '=', $userId);
            // })->count();
        }

        $mediaAtividadesCompletas = 0;
        $somatoria = 0;
        $total = 0;

        $participativos = 0;

        if($somatoria > 0)
        {
            $mediaAtividadesCompletas = number_format($total / $somatoria, 2);

            $participacao = number_format( ($participativos * 100) / $somatoria, 2);
        }
        else
        {
            $mediaAtividadesCompletas = 0;

            $participacao = 0;
        }

        // Turmas
        if(strtoupper(Auth::user()->permissao) == "Z")
        {
            $turmas = Turma::with('alunos_user')->get();
        }
        else if(strtoupper(Auth::user()->permissao) == "G")
        {
            $turmas = Turma::with('alunos_user')->where('escola_id', '=', Auth::user()->escola_id)
                ->orWhere('user_id', '=', $userId)->get();
        }
        else
        {
            $turmas = Turma::with('alunos_user')->where('user_id', '=', $userId)->get();
        }

        foreach ($turmas as $turma)
        {
            $turma->qt_alunos = AlunoTurma::where('turma_id', '=', $turma->id)->count();

            $turma->qt_postagens = PostagemTurma::where([['turma_id', '=', $turma->id]])->count();

            $turma->qt_comentarios = 0;

            foreach(PostagemTurma::with('comentarios')->where([['turma_id', '=', $turma->id]])->get() as $postagem)
            {
                $turma->qt_comentarios += count($postagem->comentarios);
            }

            $turma->qt_duvidas = DuvidaProfessor::where([['professor_id', '=', $turma->user_id]])->count();

            $turma->alunosInativos = collect();

            $turma->alunosRisco = collect();

            $now = Carbon::now();

            $turma->qt_alunos_participativos = 0;

            foreach($turma->alunos_user as $aluno)
            {
                // dd($aluno->user);

                $aluno->qt_postagens = PostagemTurma::where([['user_id', '=', $aluno->user_id], ['turma_id', '=', $aluno->turma_id]])->count();

                $aluno->qt_comentarios = ComentarioPostagemTurma::where([['user_id', '=', $aluno->user_id]])->count();

                $aluno->qt_duvidas = DuvidaProfessor::where([['user_id', '=', $aluno->user_id], ['professor_id', '=', $turma->user_id]])->count();

                if($aluno->qt_postagens > 0 || $aluno->qt_comentarios > 0 || $aluno->qt_duvidas > 0)
                {
                    $turma->qt_alunos_participativos ++;
                }

                if($aluno->user != null ? $aluno->user->ultima_atividade != null : false)
                {
                    $diff = Carbon::parse($aluno->user->ultima_atividade)->diffInDays($now);

                    if($diff >= 30)
                    {
                        $turma->alunosInativos->push($aluno);
                    }

                    if($aluno->user->created_at == $aluno->user->ultima_atividade)
                    {
                        $turma->alunosRisco->push($aluno);
                    }
                }
            }

            $turma->participacaoAlunos = 0;

            if($turma->qt_alunos > 0)
            {
                $turma->participacaoAlunos = number_format(($turma->qt_alunos_participativos * 100) / $turma->qt_alunos, 2, ",", ".");
            }

            // dd($turma->alunosInativos);
        }

        foreach($alunos as $aluno)
        {
            $aluno->qt_acessos = Metrica::where([['titulo', '=', 'Acesso na plataforma'], ['user_id', '=', $aluno->id]])->count();

            if(AlunoTurma::where('user_id', '=', $aluno->id)->first() != null)
            {
                $aluno->qt_postagens = PostagemTurma::where([['user_id', '=', $aluno->id], ['turma_id', '=', AlunoTurma::where('user_id', '=', $aluno->id)->first()->turma_id]])->count();

                $aluno->qt_duvidas = DuvidaProfessor::where([['user_id', '=', $aluno->id], ['professor_id', '=', $turma->id]])->count();
            }
            else
            {
                $aluno->qt_postagens = 0;

                $aluno->qt_duvidas = 0;
            }

            $aluno->qt_comentarios = ComentarioPostagemTurma::where([['user_id', '=', $aluno->id]])->count();

            foreach($aluno->progressos as $progresso)
            {
                if($progresso->tipo == 1)
                {
                    if(Aplicacao::find($progresso->conteudo_id) != null)
                    {
                        $progresso->titulo = Aplicacao::find($progresso->conteudo_id)->titulo;
                    }
                    else
                    {
                        $progresso->titulo = "Aplicação " . $progresso->conteudo_id;
                    }
                }
                else if($progresso->tipo == 2)
                {
                    if(Conteudo::find($progresso->conteudo_id) != null)
                    {
                        $progresso->titulo = Conteudo::find($progresso->conteudo_id)->titulo;
                    }
                    else
                    {
                        $progresso->titulo = "Conteúdo " . $progresso->conteudo_id;
                    }
                }
            }

            $aluno->interacoes = collect();

            foreach(InteracaoConteudo::where('user_id', '=', $aluno->id)->select('conteudo_id','tipo')->get()->unique(function ($item) {
                return $item['conteudo_id'].$item['tipo'];
            }) as $interacao)
            {
                $ic = InteracaoConteudo::where([['conteudo_id', '=', $interacao->conteudo_id], ['tipo', '=', $interacao->tipo], ['user_id', '=', $aluno->id]])->first();

                if($ic == null)
                {
                    continue;
                }

                if($ic->tipo == 1)
                {
                    if(Aplicacao::find($ic->conteudo_id) != null)
                    {
                        $ic->titulo = Aplicacao::find($ic->conteudo_id)->titulo;
                    }
                    else
                    {
                        $ic->titulo = "Aplicação " . $ic->conteudo_id;
                    }
                }
                else if($ic->tipo == 2)
                {
                    if(Conteudo::find($ic->conteudo_id) != null)
                    {
                        $ic->titulo = Conteudo::find($ic->conteudo_id)->titulo;
                    }
                    else
                    {
                        $ic->titulo = "Conteúdo " . $ic->conteudo_id;
                    }
                }

                $total_interacoes = 0;

                $tempo_medio = 0;

                $tempo_total = 0;

                foreach(InteracaoConteudo::where([['conteudo_id', '=', $interacao->conteudo_id], ['tipo', '=', $interacao->tipo], ['user_id', '=', $aluno->id]])->get() as $int)
                {
                    $total_interacoes ++;

                    $tempo_total += Carbon::parse($int->inicio)->diffInSeconds(Carbon::parse($int->created_at));
                }

                if($total_interacoes > 0)
                {
                    $tempo_medio = $tempo_total / $total_interacoes;
                }

                $ultima_interacao = InteracaoConteudo::where([['conteudo_id', '=', $interacao->conteudo_id], ['tipo', '=', $interacao->tipo], ['user_id', '=', $aluno->id]])->orderBy('created_at', 'desc')->first()->created_at;

                $interacao = [ "conteudo_id" => $interacao->conteudo_id, "tipo" => $interacao->tipo, "titulo" => $ic->titulo, "tempo_medio" => $tempo_medio, "tempo_total" => $tempo_total, 'ultima_interacao' => $ultima_interacao ];

                $aluno->interacoes->push($interacao);
            }

            // dd($aluno->interacoes);

        }

        // dd($alunos);

        foreach ($turmas as $turma)
        {
            $turma->qt_alunos = AlunoTurma::where('turma_id', '=', $turma->id)->count();

            $turma->qt_postagens = PostagemTurma::where([['turma_id', '=', $turma->id]])->count();

            $turma->qt_comentarios = 0;

            foreach(PostagemTurma::with('comentarios')->where([['turma_id', '=', $turma->id]])->get() as $postagem)
            {
                $turma->qt_comentarios += count($postagem->comentarios);
            }

            $turma->qt_duvidas = DuvidaProfessor::where([['professor_id', '=', $turma->user_id]])->count();

            $turma->alunosInativos = collect();

            $turma->alunosRisco = collect();

            $now = Carbon::now();

            $turma->qt_alunos_participativos = 0;

            foreach($turma->alunos_user as $aluno)
            {
                // dd($aluno->user);

                $aluno->qt_postagens = PostagemTurma::where([['user_id', '=', $aluno->user_id], ['turma_id', '=', $aluno->turma_id]])->count();

                $aluno->qt_comentarios = ComentarioPostagemTurma::where([['user_id', '=', $aluno->user_id]])->count();

                $aluno->qt_duvidas = DuvidaProfessor::where([['user_id', '=', $aluno->user_id], ['professor_id', '=', $turma->user_id]])->count();

                if($aluno->qt_postagens > 0 || $aluno->qt_comentarios > 0 || $aluno->qt_duvidas > 0)
                {
                    $turma->qt_alunos_participativos ++;
                }

                if($aluno->user != null ? $aluno->user->ultima_atividade != null : false)
                {
                    $diff = Carbon::parse($aluno->user->ultima_atividade)->diffInDays($now);

                    if($diff >= 30)
                    {
                        $turma->alunosInativos->push($aluno);
                    }

                    if($aluno->user->created_at == $aluno->user->ultima_atividade)
                    {
                        $turma->alunosRisco->push($aluno);
                    }
                }
            }

            $turma->participacaoAlunos = 0;

            if($turma->qt_alunos > 0)
            {
                $turma->participacaoAlunos = number_format(($turma->qt_alunos_participativos * 100) / $turma->qt_alunos, 2, ",", ".");
            }

            // dd($turma->alunosInativos);
        }

        // $metricas = Metrica::all();

        // dd($metricas->groupBy('titulo'));

        $metricas = Metrica::query();

        $metricas->when( Auth::user()->permissao != "Z", function ($q) use ($escola) {
            return $q->whereHas('user', function ($q2) use ($escola) {
                $q2->where('escola_id', $escola->id);
            });
        });

        $metricas = $metricas->pluck('titulo')->unique();

        // dd($metricas);

        $metricaAcessosPlataforma = Metrica::where([['titulo', 'Acesso na plataforma']])
        ->whereHas('user', function ($query) use ($escola) {
            $query->where('escola_id', $escola->id);
        })
        ->orderBy('created_at', 'asc')->get(['user_id', 'created_at'])->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('d/m/Y');
        });

        foreach ($metricaAcessosPlataforma as $key => $metrica)
        {
            $metricaAcessosPlataforma[$key] = count($metrica);
        }

        if(AvaliacaoInstrutor::where('instrutor_id', '=', Auth::user()->id)->avg('avaliacao') > 0)
        {
            $avaliacaoInstrutor = AvaliacaoInstrutor::where('instrutor_id', '=', Auth::user()->id)->avg('avaliacao');
        }
        else
        {
            $avaliacaoInstrutor = '-';
        }

        $avaliacoes = AvaliacaoInstrutor::with('user')->where('instrutor_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('gestao.relatorios')->with(compact('escolas', 'escola', 'turmas', 'alunos', 'cursos',
        'totalEscolas', 'totalGestores', 'totalProfessores', 'totalTurmas', 'totalAlunos',
        'mediaAtividadesCompletas', 'participacao', 'mediaAlunosConectados', 'nivelAprendizado', 'conteudos',
        'totalMatriculados', 'cursos', 'avaliacoes', 'avaliacaoInstrutor',
        'metricas', 'metricaAcessosPlataforma'));
    }

    public function avaliacoesProfessor($idProfessor)
    {
        $professor = User::with('escola', 'turmas_instrutor')->find($idProfessor);

        foreach ($professor->turmas_instrutor as $turma)
        {
            $turma->qt_alunos = AlunoTurma::where('turma_id', '=', $turma->id)->count();
        }

        if($professor == null)
        {
            return redirect()->back()->withErrors("Professor não encontrado!");
        }
        else if(strtoupper($professor->permissao) != "P" && strtoupper($professor->permissao) != "G" && strtoupper($professor->permissao) != "Z")
        {
            return redirect()->back()->withErrors("Professor não encontrado!");
        }

        //Relatorios avaliacoes instrutor

        if(AvaliacaoInstrutor::where('instrutor_id', '=', $idProfessor)->avg('avaliacao') > 0)
            $avaliacaoInstrutor = AvaliacaoInstrutor::where('instrutor_id', '=', $idProfessor)->avg('avaliacao');
        else
            $avaliacaoInstrutor = '-';

        $avaliacoes = AvaliacaoInstrutor::with('user')->where('instrutor_id', '=', $idProfessor)->orderBy('created_at', 'desc')->get();

        return view('professor.avaliacoes')->with(compact('professor', 'avaliacoes', 'avaliacaoInstrutor'));
    }
}


