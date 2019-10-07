<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\AvaliacaoInstrutor;
use App\AlunoTurma;
use App\Entities\GamificacaoUsuario\GamificacaoUsuario;
use App\Turma;
use App\User;


use App\Escola;
use App\Conteudo;
use App\Aplicacao;
use App\Categoria;

use App\Curso;
use App\Aula;
use App\ConteudoAula;
use App\Matricula;


class GestaoController extends Controller
{
    public function index()
    {
        // return redirect()->route('gestao.biblioteca');

        return redirect()->route('gestao.cursos');
    }

    public function biblioteca()
    {
        $conteudos = Conteudo::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $conteudos = Conteudo::when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        })
        ->get();

        $aplicacoes = Aplicacao::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $aplicacoes = Aplicacao::when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        })
        ->get();

        $videos = $conteudos->filter(function ($c) {
            return $c->tipo == 3;
        });

        $slides = $conteudos->filter(function ($c) {
            return ($c->tipo == 4 && (strpos($c->conteudo, ".ppt") !== false || strpos($c->conteudo, ".pptx") !== false));
        });

        $documentos = $conteudos->filter(function ($c) {
            return $c->tipo == 1 || ($c->tipo == 4 && (strpos($c->conteudo, ".ppt") == false && strpos($c->conteudo, ".pptx") == false));
        });

        $apostilas = $conteudos->filter(function ($c) {
            return $c->tipo == 11;
        });

        return view('gestao.biblioteca')->with(compact('conteudos', 'videos', 'slides', 'apostilas', 'documentos', 'aplicacoes'));
    }

    public function postNovoConteudo(Request $request)
    {
        // dd($request);

        if($request->descricao == null)
        {
            $request->descricao = '';
        }

        if($request->obrigatorio == null)
        {
            $request->obrigatorio = 0;
        }
        elseif($request->obrigatorio == 'on')
        {
            $request->obrigatorio = 1;
        }

        if($request->tempo == null)
        {
            $request->tempo = 0;
        }

        if($request->fonte == null)
        {
            $request->fonte = '';
        }

        if($request->autores == null)
        {
            $request->autores = '';
        }

        switch ($request->tipo)
        {
            case 1:
                $conteudo = $request->conteudo;
                break;

            case 2:
                if(isset($request->arquivoAudio))
                    $request->arquivo = $request->arquivoAudio;
                else
                    $request->conteudo = $request->conteudoAudio;
                break;

            case 3:
                if(isset($request->arquivoVideo))
                    $request->arquivo = $request->arquivoVideo;
                else
                    $request->conteudo = $request->conteudoVideo;
                break;

            case 4:
                if(isset($request->arquivoSlide))
                    $request->arquivo = $request->arquivoSlide;
                else
                    $request->conteudo = $request->conteudoSlide;
                break;

            default:
                $conteudo = $request->conteudo;
                break;
        }

        if($request->tipo == 2 || $request->tipo == 3 || $request->tipo == 4 || $request->tipo == 6)
        {
            if(isset($request->arquivo))
            {
                $originalName = mb_strtolower( $request->arquivo->getClientOriginalName(), 'utf-8' );

                $fileExtension = \File::extension($request->arquivo->getClientOriginalName());
                $newFileNameArquivo =  md5( $request->arquivo->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

                $pathArquivo = $request->arquivo->storeAs('uploads/conteudos', $newFileNameArquivo, 'local');

                if(!\Storage::disk('local')->put($pathArquivo, file_get_contents($request->arquivo)))
                {
                    \Session::flash('error', 'Não foi possível fazer upload de seu conteúdo!');
                }
                else
                {
                    $conteudo = $newFileNameArquivo;
                }
            }
            else
            {
                $conteudo = $request->conteudo;
            }
        }

        $novo_conteudo = Conteudo::create([
            'user_id' => \Auth::user()->id,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'tipo' => $request->tipo,
            'conteudo' => $conteudo,
            'tempo' => $request->tempo,
            'apoio' => $request->apoio,
            'fonte' => $request->fonte,
            'autores' => $request->autores,
            'status' => $request->status,
        ]);

        return Redirect::route('gestao.biblioteca')->with('message', 'Conteúdo criado com sucesso!');
    }

    public function editarConteudo($idConteudo)
    {
        if(Conteudo::where([['id', '=', $idConteudo]])->first() != null)
        {
            $conteudo = Conteudo::where([['id', '=', $idConteudo]])->first();

            if($conteudo->tipo == 2 || $conteudo->tipo == 3 || $conteudo->tipo == 4 || $conteudo->tipo == 6)
            {
                if(\Storage::disk('local')->has('uploads/conteudos/' . $conteudo->conteudo))
                {
                    $conteudo->temArquivo = true;
                }
                else
                {
                    $conteudo->temArquivo = false;
                }
            }

            return response()->json(['success'=> 'Conteudo encontrado..', 'conteudo' => json_encode($conteudo)]);
        }
        else
        {
            return response()->json(['error' => 'Conteúdo não encontrado!']);
        }
    }

    public function postSalvarConteudo(Request $request)
    {
        // dd($request);

        if(Conteudo::where([['id', '=', $request->idConteudo]])->first() != null)
        {
            $conteudoOriginal = Conteudo::where([['id', '=', $request->idConteudo]])->first();

            if($request->descricao == null)
            {
                $request->descricao = '';
            }

            if($request->obrigatorio == null)
            {
                $request->obrigatorio = 0;
            }
            elseif($request->obrigatorio == 'on')
            {
                $request->obrigatorio = 1;
            }

            if($request->tempo == null)
            {
                $request->tempo = 0;
            }

            if($request->fonte == null)
            {
                $request->fonte = '';
            }

            if($request->autores == null)
            {
                $request->autores = '';
            }

            switch ($request->tipo)
            {
                case 1:
                    $conteudo = $request->conteudo;
                    break;

                case 2:
                    if(isset($request->arquivoAudio))
                        $request->arquivo = $request->arquivoAudio;
                    else
                        $request->conteudo = $request->conteudoAudio;
                    break;
                case 3:
                    if(isset($request->arquivoVideo))
                        $request->arquivo = $request->arquivoVideo;
                    else
                        $request->conteudo = $request->conteudoVideo;
                    break;
                case 4:
                    if(isset($request->arquivoSlide))
                        $request->arquivo = $request->arquivoSlide;
                    else
                        $request->conteudo = $request->conteudoSlide;
                    break;

                default:
                    $conteudo = $request->conteudo;
                    break;
            }

            if($request->tipo == 2 || $request->tipo == 3 || $request->tipo == 4 || $request->tipo == 6)
            {
                if(isset($request->arquivo))
                {
                    if($conteudoOriginal->conteudo != null)
                    {
                        if(\Storage::disk('local')->has('uploads/conteudos/' . $conteudoOriginal->conteudo))
                        {
                            \Storage::disk('local')->delete('uploads/conteudos/' . $conteudoOriginal->conteudo);
                        }
                    }

                    $originalName = mb_strtolower( $request->arquivo->getClientOriginalName(), 'utf-8' );

                    $fileExtension = \File::extension($request->arquivo->getClientOriginalName());
                    $newFileNameArquivo =  md5( $request->arquivo->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

                    $pathArquivo = $request->arquivo->storeAs('uploads/conteudos', $newFileNameArquivo, 'local');

                    if(!\Storage::disk('local')->put($pathArquivo, file_get_contents($request->arquivo)))
                    {
                        \Session::flash('error', 'Não foi possível fazer upload de seu conteúdo!');
                    }
                    else
                    {
                        $conteudo = $newFileNameArquivo;
                    }
                }
                else
                {
                    if($request->conteudo != "" && $request->conteudo != null)
                        $conteudo = $request->conteudo;
                    else
                        $conteudo = $conteudoOriginal->conteudo;
                }
            }

            $conteudoOriginal->update([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'conteudo' => $conteudo,
                'fonte' => $request->fonte,
                'autores' => $request->autores,
                'status' => $request->status,
            ]);

            return Redirect::route('gestao.biblioteca')->with('message', 'Conteúdo atualizado com sucesso!');
        }
        else
        {
            return response()->json(['error' => 'Conteúdo não encontrado!']);
        }
    }

    public function postDuplicarConteudo(Request $request)
    {
        if(Conteudo::where([['id', '=', $request->idConteudo]])->first() != null)
        {
            $newConteudo = Conteudo::where([['id', '=', $request->idConteudo]])->first()->replicate();

            $newConteudo->id = null;
            // $newConteudo->id = Conteudo::max('id') + 1;

            $newConteudo->save();

            \Session::flash('message', 'Conteúdo duplicado com sucesso!');
            return redirect()->route('gestao.biblioteca');
        }
        else
        {
            return Redirect::back()->withErrors(['Conteúdo não encontrado!']);
        }
    }

    public function postExcluirConteudo($idConteudo, Request $request)
    {
        if(Conteudo::find($idConteudo) != null)
        {
            $conteudo = Conteudo::where([['id', '=', $request->idConteudo]])->first();

            if($conteudo->tipo == 2 || $conteudo->tipo == 3 || $conteudo->tipo == 4 || $conteudo->tipo == 6)
            {
                if($conteudo->conteudo != null)
                {
                    if(\Storage::disk('local')->has('uploads/conteudos/' . $conteudo->conteudo))
                    {
                        \Storage::disk('local')->delete('uploads/conteudos/' . $conteudo->conteudo);
                    }
                }
            }

            Conteudo::find($idConteudo)->delete();

            // \Session::flash('message', 'Conteúdo excluído com sucesso!');
            // return redirect()->route('gestao.biblioteca');
            return response()->json(["success" => "Aplicação excluída com sucesso!"]);
        }
        else
        {
            // return Redirect::back()->withErrors(['Conteúdo não encontrado!']);
            return response()->json(["error" => "Aplicação não encontrada!"]);
        }
    }

    public function cursosProfessores()
    {
        $cursos = Curso::query();

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $cursos->when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $is_admin = strtoupper(Auth::user()->permissao) == "Z";

        $cursos->when( $is_admin == false, function ($query) {
            return $query->where([['tipo', '=', 2], ['escola_id', '=', Auth::user()->escola_id], ['user_id', '=', Auth::user()->id]])
            ->orWhere([['tipo', '=', 2], ['user_id', '=', Auth::user()->id]]);
        });

        $cursos->when( $is_admin == true, function ($query) {
            return $query->where([['tipo', '=', 2]]);
        });

        $cursos = $cursos
        ->where([['status', '=', 1]])
        ->orderBy('id', 'DESC')
        ->get();

        // $cursos = $cursos->get();

        return view('gestao.cursos-professores')->with(compact('cursos'));
    }

    public function cursos()
    {
        $cursos = Curso::query();

        $is_admin = strtoupper(Auth::user()->permissao) == "Z";

        $cursos->when($is_admin == false, function ($query) {
            return $query->where([['escola_id', '==', Auth::user()->escola_id], ['user_id', '=', Auth::user()->id]])
            ->orWhere('user_id', '=', Auth::user()->id);
        });

        $tem_pesquisa = Input::has('pesquisa') ? (Input::get('pesquisa') != null && Input::get('pesquisa') != "") : false;

        $cursos->when($tem_pesquisa, function ($query) {
            return $query
            ->where('titulo', 'like', '%' . Input::get('pesquisa') . '%')
            ->orWhere('descricao', 'like', '%' . Input::get('pesquisa') . '%');
        });

        $cursos = $cursos->get();

        return view('gestao.cursos')->with(compact('cursos'));
    }

    public function novoCurso()
    {
        $categorias = Categoria::all();

        return view('gestao.novo-curso')->with(compact('categorias'));
    }

    public function postNovoCurso(Request $request)
    {
        if(strtoupper(Auth::user()->permissao) == "E")
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

        // $escola->caracteristicas = json_decode($escola->caracteristicas);

        if($request->preco == null)
        {
            $request->preco = 0;
        }

        if($request->senha == null)
        {
            $request->senha = '';
        }

        if($request->descricao_curta == null)
        {
            $request->descricao_curta = '';
        }

        if($request->descricao == null)
        {
            $request->descricao = '';
        }

        if(isset($request->escola_id) ? $request->escola_id == null : true)
        {
            $request->escola_id = 1;
        }

        $request->preco = str_replace(".", "", $request->preco);
        $request->preco = str_replace(",", ".", $request->preco);

        $curso = Curso::create([
            'escola_id' => $request->escola_id, //$escola->id,
            'user_id' => \Auth::user()->id,
            'titulo' => $request->titulo,
            'descricao_curta' => $request->descricao_curta,
            'descricao' => $request->descricao,
            'categoria' => $request->categoria,
            'tipo' => ($request->tipo === 1 || $request->tipo === 2) ? $request->tipo : 1,
            'visibilidade' => $request->visibilidade,
            'senha' => $request->senha,
            'preco' => $request->preco,
            'periodo' => $request->periodo,
            'vagas' => $request->vagas,
        ]);

        if($request->capa !=null)
        {
            $fileExtension = \File::extension($request->capa->getClientOriginalName());
            $newFileNameCapa =  md5( $request->capa->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

            $pathCapa = $request->capa->storeAs('cursos/capas', $newFileNameCapa, 'public_uploads');

            if(!\Storage::disk('public_uploads')->put($pathCapa, file_get_contents($request->capa)) )
            {
                \Session::flash('middle_popup', 'Ops! Não foi possivel enviar a capa.');
                \Session::flash('popup_style', 'danger');
            }
            else
            {
                $curso->capa = $newFileNameCapa;

                $curso->save();
            }
        }

        if($request->rascunho == true)
        {
            return redirect()->route('gestao.cursos');
        }
        else
        {
            return redirect()->route('gestao.curso-conteudo', ['idCurso' => $curso->id]);
        }
    }

    public function postSalvarCurso($idCurso, Request $request)
    {
        // dd($request);

        if(strtoupper(Auth::user()->permissao) == "E")
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

        // $escola->caracteristicas = json_decode($escola->caracteristicas);

        if(Curso::find($idCurso))
        {
            $curso = Curso::find($idCurso);

            // $reques->validate([
            //     'titulo' => 'required|max:255',
            //     'descricao_curta' => 'required|max:255',
            //     'descricao' => 'required',
            //     'categoria' => 'required',
            //     'visibilidade' => 'required',
            //     'senha' => 'required',
            //     'preco' => 'required',
            //     'periodo' => 'required',
            //     'vagas' => 'required|integer|min:0',
            // ]);

            if($request->preco == null)
            {
                $request->preco = 0;
            }

            if($request->senha == null)
            {
                $request->senha = '';
            }

            if($request->preco == null)
            {
                $request->preco = 0;
            }

            if($request->vagas == null)
            {
                $request->vagas = 0;
            }

            if($request->senha == null)
            {
                $request->senha = '';
            }

            if($request->descricao == null)
            {
                $request->descricao = '';
            }

            if(isset($request->escola_id) ? $request->escola_id == null : true)
            {
                $request->escola_id = 1;
            }

            $request->preco = str_replace(".", "", $request->preco);
            $request->preco = str_replace(",", ".", $request->preco);

            $curso->update([
                'escola_id' => $request->escola_id, //$escola->id,
                'titulo' => $request->titulo,
                'descricao_curta' => $request->descricao_curta,
                'descricao' => $request->descricao,
                'categoria' => $request->categoria,
                'tipo' => $request->tipo,
                'visibilidade' => $request->visibilidade,
                'senha' => $request->senha,
                'preco' => $request->preco,
                'periodo' => $request->periodo,
                'vagas' => $request->vagas,
            ]);

            if($request->capa != null)
            {
                $fileExtension = \File::extension($request->capa->getClientOriginalName());
                $newFileNameCapa =  md5( $request->capa->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

                $pathCapa = $request->capa->storeAs('cursos/capas', $newFileNameCapa, 'public_uploads');

                if(!\Storage::disk('public_uploads')->put($pathCapa, file_get_contents($request->capa)) )
                {
                    \Session::flash('middle_popup', 'Ops! Não foi possivel enviar a capa.');
                    \Session::flash('popup_style', 'danger');
                }
                else
                {
                    if($curso->capa != null)
                    {
                        if(\Storage::disk('public_uploads')->has('cursos/capas/' . $curso->capa))
                        {
                            \Storage::disk('public_uploads')->delete('cursos/capas/' . $curso->capa);
                        }
                    }

                    $curso->capa = $newFileNameCapa;

                    $curso->save();
                }
            }

            return Redirect::back()->with('message', 'Curso atualizado com sucesso!');
        }
        else
        {
            return Redirect::back()->withErrors(['Curso não encontrado!']);
        }
    }

    public function postExcluirCurso($idCurso)
    {
        if(Curso::find($idCurso))
        {
            if(Curso::find($idCurso)->user_id == Auth::user()->id || strtolower(Auth::user()->permissao) == "z")
            {
                foreach (ConteudoAula::where([['curso_id', '=', $idCurso]])->get() as $key => $conteudo)
                {
                    if($conteudo->tipo == 2 || $conteudo->tipo == 3 || $conteudo->tipo == 4 || $conteudo->tipo == 6)
                    {
                        if($conteudo->conteudo != null)
                        {
                            if(\Storage::disk('local')->has('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudo->conteudo))
                            {
                                \Storage::disk('local')->delete('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudo->conteudo);
                            }

                            // // Google cloud storage
                            // if(\Storage::disk('gcs')->has('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudo->conteudo))
                            // {
                            //     \Storage::disk('gcs')->delete('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudo->conteudo);
                            // }
                        }
                    }

                    $conteudo->delete();
                }

                Aula::where([['curso_id', '=', $idCurso]])->delete();

                Curso::find($idCurso)->delete();

                return Redirect::back()->with('message', 'Curso excluido com sucesso!');
            }
            else
            {
                return Redirect::back()->with('error', 'Ação não permitida!');
            }
        }
        else
        {
            return Redirect::back()->with('error', 'Curso não encontrado!');
        }
    }

    public function postPublicarCurso($idCurso)
    {
        if(Curso::find($idCurso))
        {
            if(Curso::find($idCurso)->status == 0)
            {
                if(\App\ConteudoAula::where('curso_id', '=', $idCurso)->exists() == false)
                {
                    return Redirect::back()->withErrors(['Você não pode publicar um curso sem nenhum conteúdo!']);
                }

                // if(Curso::find($idCurso)->preco > 0 && !WirecardAccount::where('user_id', '=', Auth::user()->id)->exists())
                // {
                //     return Redirect::back()->withErrors(['Você não pode publicar um curso pago, sem antes vincular sua conta Wirecard!']);
                // }

                Curso::find($idCurso)->update([
                    'status' => 1,
                    'data_publicacao' => date('Y-m-d H:i:s'),
                ]);

                return Redirect::back()->with('message', 'Curso publicado com sucesso!');
            }
            else
            {
                Curso::find($idCurso)->update(['status' => 0]);

                return Redirect::back()->with('message', 'Curso despublicado com sucesso!');
            }
        }
        else
        {
            return Redirect::back()->withErrors(['Curso não encontrado!']);
        }
    }

    public function conteudoCurso($idCurso, Request $request)
    {
        $curso = Curso::with('aulas')->find($idCurso);

        // dd($curso);

        if($curso == null)
        {
            return redirect()->route('gestao.cursos');
            // return redirect()->back();
        }

        if($request->aula != null)
        {
            if($curso->aulas->filter(function($item) { return $item->id == \Request::get('aula'); })->first() == null)
            {
                return redirect()->route('gestao.curso-conteudo', ['idCurso' => $idCurso]);
            }
        }

        if($curso->data_publicacao != null && $curso->periodo > 0)
        {
            $curso->data_publicacao = \Carbon\Carbon::parse($curso->data_publicacao);

            $curso->data_expiracao = new \Carbon\Carbon($curso->data_publicacao);
            $curso->data_expiracao->addDays($curso->periodo);

            $curso->periodo_restante = \Carbon\Carbon::now()->diffInDays( $curso->data_expiracao );

            if($curso->data_expiracao->gt( \Carbon\Carbon::now() ) == false)
            {
                $curso->periodo_restante *= -1;
            }

            // dd($curso->data_publicacao);

            // dd($curso->data_expiracao);
        }
        else
        {
            $curso->periodo_restante = 0;
        }

        $curso->matriculados = Matricula::with('user')->where('curso_id', '=', $curso->id)->whereHas('user')->count();

        $curso->vagasRestante = $curso->vagas - $curso->matriculados;

        $categorias = Categoria::all();

        return view('gestao.curso-conteudo')->with(compact('curso', 'categorias'));
    }

    public function postNovaAula($idCurso, Request $request)
    {
        // dd($request);

        if(strtoupper(Auth::user()->permissao) == "E")
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

        // $escola->caracteristicas = json_decode($escola->caracteristicas);

        if($request->duracao == null)
        {
            $request->duracao = 0;
        }

        if($request->requisito == "aula")
        {
            if($request->aula_especifica == null)
                $request->requisito_id = 0;
            else
                $request->requisito_id = $request->aula_especifica;
        }
        else
        {
            $request->requisito_id = 0;
        }

        $newAula = Aula::create([
            'id' => Aula::where('curso_id', '=', $idCurso)->max('id') + 1,
            'curso_id' => $idCurso,
            'user_id' => \Auth::user()->id,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'duracao' => $request->duracao,
            'requisito' => $request->requisito,
            'requisito_id' => $request->requisito_id,
        ]);

        return Redirect::route('gestao.curso-conteudo', ['curso' => $idCurso, 'aula' => $newAula->id]);
        // return redirect()->back();
    }

    public function editarAula($idCurso, $idAula)
    {

        if(Aula::where([['id', '=', $idAula], ['curso_id', '=', $idCurso]])->first() != null)
        {
            $aula = Aula::where([['id', '=', $idAula], ['curso_id', '=', $idCurso]])->first();

            return response()->json(['success'=> 'Aula encontrada.', 'aula' => json_encode($aula)]);
            return response()->json(['aula' => $aula]);
        }
        else
        {
            return response()->json(['error' => 'Não encontrado']);
        }
    }

    public function postEditarAula($idCurso, Request $request)
    {
        // dd($request);

        if(Aula::where([['id', '=', $request->idAula], ['curso_id', '=', $idCurso]]) != null)
        {
            if($request->duracao == null)
            {
                $request->duracao = 0;
            }

            if($request->requisito == "aula")
            {
                if($request->aula_especifica == null)
                    $request->requisito_id = 0;
                else
                    $request->requisito_id = $request->aula_especifica;
            }
            else
            {
                $request->requisito_id = 0;
            }

            Aula::where([['id', '=', $request->idAula], ['curso_id', '=', $idCurso]])->update([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'duracao' => $request->duracao,
                'requisito' => $request->requisito,
                'requisito_id' => $request->requisito_id,
            ]);

            return Redirect::back()->with('message', 'Aula atualizada com sucesso!');
        }
        else
        {
            return Redirect::back()->withErrors(['Aula não encontrada!']);
        }
    }

    public function reordenarAula($idCurso, $idAula, $index)
    {
        if(Aula::where([['id', '=', $idAula], ['curso_id', '=', $idCurso]])->first() != null)
        {
            Aula::where([['id', '=', $idAula], ['curso_id', '=', $idCurso]])->update([
                'id' => 999
            ]);
            Conteudo::where([['aula_id', '=', $idAula], ['curso_id', '=', $idCurso]])->update([
                'aula_id' => 999
            ]);

            if(Aula::where([['id', '=', $index], ['curso_id', '=', $idCurso]])->first() != null)
            {
                Aula::where([['id', '=', $index], ['curso_id', '=', $idCurso]])->update([
                    'id' => $idAula,
                ]);
                Conteudo::where([['aula_id', '=', $index], ['curso_id', '=', $idCurso]])->update([
                    'aula_id' => $idAula
                ]);
            }

            Aula::where([['id', '=', '999'], ['curso_id', '=', $idCurso]])->update([
                'id' => $index
            ]);
            Conteudo::where([['aula_id', '=', '999'], ['curso_id', '=', $idCurso]])->update([
                'aula_id' => $index
            ]);

            return response()->json(['success'=> 'Aula reordenada com sucesso!' . $idAula . '-' . $index]);
        }
        else
        {
            return response()->json(['error' => 'Aula não encontrada!']);
        }
    }

    public function postDuplicarAula($idCurso, Request $request)
    {
        if(Aula::where([['id', '=', $request->idAula], ['curso_id', '=', $idCurso]])->first() != null)
        {
            $newAula = Aula::where([['id', '=', $request->idAula], ['curso_id', '=', $idCurso]])->first()->withConteudos()->replicate();

            $newAula->id = Aula::where('curso_id', '=', $idCurso)->max('id') + 1;

            foreach ($newAula->conteudos as $key => $conteudo)
            {
                $conteudo = $conteudo->replicate();
                $conteudo->id = $key + 1;
                $conteudo->aula_id = $newAula->id;
                $conteudo->save();
            }

            unset($newAula->conteudos);

            $newAula->save();

            \Session::flash('message', 'Aula duplicada com sucesso!');
            return redirect()->route('gestao.curso-conteudo', ['idCurso' => $idCurso, 'aula' => $request->idAula]);

            // return Redirect::back()->with('message', 'Aula duplicada com sucesso!');
        }
        else
        {
            return Redirect::back()->withErrors(['Aula não encontrado!']);
        }
    }

    public function postExcluirAula($idCurso, Request $request)
    {
        if(Aula::where([['id', '=', $request->idAula], ['curso_id', '=', $idCurso]])->first() != null)
        {
            Aula::where([['id', '=', $request->idAula], ['curso_id', '=', $idCurso]])->delete();

            $conteudosAula = ConteudoAula::where([['aula_id', '=', $request->idAula], ['curso_id', '=', $idCurso]])->get();
            foreach($conteudosAula as $conteudoAula)
            {
                Conteudo::where([['id', '=', $conteudoAula->conteudo_id]])->delete();
            }

            ConteudoAula::where([['aula_id', '=', $request->idAula], ['curso_id', '=', $idCurso]])->delete();

            return Redirect::back()->with('message', 'Aula excluida com sucesso!');
        }
        else
        {
            return Redirect::back()->withErrors(['Aula não encontrada!']);
        }
    }

    public function aulaConteudos($idCurso, $idAula)
    {
        if(Aula::where([['id', '=', $idAula], ['curso_id', '=', $idCurso]])->first() != null)
        {
            $aula = Aula::where([['id', '=', $idAula], ['curso_id', '=', $idCurso]])->first();//->withConteudos();

            // $aula->conteudos = Aula::withConteudos($aula);

            $aula->conteudos = ConteudoAula::join('conteudos', 'conteudo_aula.conteudo_id', '=', 'conteudos.id')
            ->whereHas('conteudo')
            ->where([['curso_id', '=', $idCurso], ['aula_id', '=', $idAula]])
            ->get();

            // dd($aula);

            // return response()->json($aula->conteudos);

            $aula->conteudos = Conteudo::detalhado($aula->conteudos);

            // dd($aula);

            return response()->json(['success'=> 'Aula encontrada.', 'aula' => json_encode($aula, JSON_PRETTY_PRINT)]);
            return response()->json(['aula' => $aula]);
        }
        else
        {
            return response()->json(['error' => 'Aula não encontrada!']);
        }
    }

    public function postNovoConteudoCurso($idCurso, Request $request)
    {
        // dd($request);

        if(Aula::where([['id', '=', $request->idAula], ['curso_id', '=', $idCurso]]) != null)
        {
            if($request->descricao == null)
            {
               $request->descricao = '';
            }

            if($request->obrigatorio == null)
            {
               $request->obrigatorio = 0;
            }
            elseif($request->obrigatorio == 'on')
            {
                $request->obrigatorio = 1;
            }

            if($request->tempo == null)
            {
               $request->tempo = 0;
            }

            if($request->apoio == null)
            {
            //    $request->apoio = '';
            }
            else
            {
                $request["apoio"] = strip_tags($request->apoio, '<a>');
            }

            if($request->fonte == null)
            {
            //    $request->fonte = '';
            }
            else
            {
                $request["fonte"] = strip_tags($request->fonte, '<a>');
            }

            if($request->autores == null)
            {
            //    $request->autores = '';
            }
            else
            {
                $request["autores"] = strip_tags($request->autores, '<a>');
            }

            switch ($request->tipo)
            {
                case 1:
                    $conteudo = $request->conteudo;
                    break;

                case 2:
                    if(isset($request->arquivoAudio))
                        $request->arquivo = $request->arquivoAudio;
                    else
                        $request->conteudo = $request->conteudoAudio;
                    break;
                case 3:
                    if(isset($request->arquivoVideo))
                        $request->arquivo = $request->arquivoVideo;
                    else
                        $request->conteudo = $request->conteudoVideo;
                    break;
                case 4:
                    if(isset($request->arquivoSlide))
                        $request->arquivo = $request->arquivoSlide;
                    else
                        $request->conteudo = $request->conteudoSlide;
                    break;
                    break;
                case 5:
                    $conteudo = $request->conteudoTransmissao;
                    break;
                case 6:
                    if(isset($request->arquivoArquivo))
                        $request->arquivo = $request->arquivoArquivo;
                    else
                        $request->conteudo = $request->conteudoArquivo;
                    break;
                case 7:
                    if($request->conteudoDissertativaDica == null)
                        $request->conteudoDissertativaDica = '';
                    if($request->conteudoDissertativaExplicacao == null)
                        $request->conteudoDissertativaExplicacao = '';

                    $conteudo = json_encode(['pergunta' => $request->conteudoDissertativa, 'dica' => $request->conteudoDissertativaDica, 'explicacao' => $request->conteudoDissertativaExplicacao]);
                    break;
                case 8:
                    $conteudo = json_encode(['pergunta' => $request->conteudoQuiz, 'alternativas' => [ $request->conteudoQuizAlternativa1, $request->conteudoQuizAlternativa2, $request->conteudoQuizAlternativa3 ], 'correta' => $request->conteudoQuizAlternativaCorreta, 'dica' => $request->conteudoQuizDica, 'explicacao' => $request->conteudoQuizExplicacao]);
                    break;
                case 9:
                    $conteudo = $request->conteudoProva;
                    break;
                case 10:
                    $conteudo = $request->conteudoEntregavel;
                    break;
                case 11:
                    if(isset($request->arquivoApostila))
                        $request->arquivo = $request->arquivoApostila;
                    else
                        $request->conteudo = $request->conteudoApostila;
                    break;

                default:
                    $conteudo = $request->conteudo;
                    break;
            }

            if($request->tipo == 2 || $request->tipo == 3 || $request->tipo == 4 || $request->tipo == 6)
            {
                if(isset($request->arquivo))
                {
                    $originalName = mb_strtolower( $request->arquivo->getClientOriginalName(), 'utf-8' );

                    $fileExtension = \File::extension($request->arquivo->getClientOriginalName());
                    $newFileNameArquivo =  md5( $request->arquivo->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

                    $pathArquivo = $request->arquivo->storeAs('uploads/cursos/' . $idCurso . '/arquivos', $newFileNameArquivo, 'local');

                    if(!\Storage::disk('local')->put($pathArquivo, file_get_contents($request->arquivo)))
                    // if(!\Storage::disk('gcs')->put($pathArquivo, file_get_contents($request->arquivo)))
                    // if(!\Storage::disk('gcs')->put('uploads/cursos/' . $idCurso . '/arquivos/' . $newFileNameArquivo, file_get_contents($request->arquivo)))
                    {
                        \Session::flash('error', 'Não foi possível fazer upload de seu conteúdo!');
                    }
                    else
                    {
                        $conteudo = $newFileNameArquivo;
                    }
                }
                else
                {
                    $conteudo = $request->conteudo;
                }
            }
            else if($request->tipo == 11)
            {
                $conteudo = "index.html";
            }

            $novo_conteudo = Conteudo::create([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'tipo' => $request->tipo,
                'conteudo' => $conteudo,
                'tempo' => $request->tempo,
                'apoio' => $request->apoio,
                'fonte' => $request->fonte,
                'autores' => $request->autores,
                'status' => $request->status,
            ]);

            if($request->tipo == 11)
            {
                $zipperFile = \Zipper::make($request->arquivo);

                $logFiles = $zipperFile->listFiles();

                // dd($logFiles);

                if(in_array("index.html", $logFiles) == false || in_array("index.js", $logFiles) == false)
                {
                    $novo_conteudo->delete();

                    return redirect()->back()->withErrors("Conteúdo do zip inválido, por favor consulte as instruções de upload de apostilas!");
                }

                $zipperFile->extractTo(public_path('uploads') . '/apostilas/' . $novo_conteudo->id . '/');

                if (!\Storage::disk('public_uploads')->has('apostilas/' . $novo_conteudo->id))
                {
                    $novo_conteudo->delete();

                    return redirect()->back()->withErrors("Não foi possível extrair o conteúdo do zip, por favor envie sua aplicação novamente!");
                }
            }

            ConteudoAula::create([
                'ordem' => ConteudoAula::where([['aula_id', '=', $request->idAula], ['curso_id', '=', $idCurso]])->max('ordem') + 1,
                'curso_id' => $idCurso,
                'aula_id' => $request->idAula,
                'conteudo_id' => $novo_conteudo->id,
                'user_id' => \Auth::user()->id,
                'obrigatorio' => $request->obrigatorio,
            ]);

            return Redirect::route('gestao.curso-conteudo', ['idCurso' => $idCurso, 'aula' => $request->idAula])->with('message', 'Conteúdo criado com sucesso!');
            // return Redirect::back()->with('message', 'Conteúdo criado com sucesso!');
        }
        else
        {
            return Redirect::back()->withErrors(['Aula não encontrada!']);
        }
    }

    public function editarConteudoCurso($idCurso, $idAula, $idConteudo)
    {
        if(Aula::where([['id', '=', $idAula], ['curso_id', '=', $idCurso]])->first() != null)
        {
            if(Conteudo::with('conteudo_aula')
            ->whereHas('conteudo_aula', function ($query) use ($idCurso, $idAula) {
                $query->where([['curso_id', '=', $idCurso], ['aula_id', '=', $idAula]]);
            })->where([['id', '=', $idConteudo]])->first() != null)
            {
                $conteudo = Conteudo::with('conteudo_aula')
                ->whereHas('conteudo_aula', function ($query) use ($idCurso, $idAula) {
                    $query->where([['curso_id', '=', $idCurso], ['aula_id', '=', $idAula]]);
                })->where([['id', '=', $idConteudo]])->first();

                if($conteudo->tipo == 2 || $conteudo->tipo == 3 || $conteudo->tipo == 4 || $conteudo->tipo == 6)
                {
                    // if(\Storage::disk('gcs')->has('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudo->conteudo))
                    // {
                    //     $conteudo->temArquivo = true;
                    // }
                    // else
                    if(\Storage::disk('local')->has('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudo->conteudo))
                    {
                        $conteudo->temArquivo = true;
                    }
                    else
                    {
                        $conteudo->temArquivo = false;
                    }
                }

                return response()->json(['success'=> 'Conteudo encontrado..', 'conteudo' => json_encode($conteudo)]);
            }
            else
            {
                return response()->json(['error' => 'Conteúdo não encontrado!']);
            }
        }
        else
        {
            return response()->json(['error' => 'Aula não encontrada!']);
        }
    }

    public function postSalvarConteudoCurso($idCurso, Request $request)
    {
        // dd($request);

        if(Aula::where([['id', '=', $request->idAula], ['curso_id', '=', $idCurso]])->first() != null)
        {
            if(Conteudo::where([['id', '=', $request->idConteudo]])->first() != null)
            {
                $conteudoOriginal = Conteudo::where([['id', '=', $request->idConteudo]])->first();

                if($request->descricao == null)
                {
                    $request->descricao = '';
                }

                if($request->obrigatorio == null)
                {
                    $request->obrigatorio = 0;
                }
                elseif($request->obrigatorio == 'on')
                {
                    $request->obrigatorio = 1;
                }

                if($request->tempo == null)
                {
                    $request->tempo = 0;
                }

                // if($request->apoio == null)
                // {
                //     $request->apoio = '';
                // }

                // if($request->fonte == null)
                // {
                //     $request->fonte = '';
                // }

                // if($request->autores == null)
                // {
                //     $request->autores = '';
                // }

                switch ($request->tipo)
                {
                    case 1:
                        $conteudo = $request->conteudo;
                        break;

                    case 2:
                        if(isset($request->arquivoAudio))
                            $request->arquivo = $request->arquivoAudio;
                        else
                            $request->conteudo = $request->conteudoAudio;
                        break;
                    case 3:
                        if(isset($request->arquivoVideo))
                            $request->arquivo = $request->arquivoVideo;
                        else
                            $request->conteudo = $request->conteudoVideo;
                        break;
                    case 4:
                        if(isset($request->arquivoSlide))
                            $request->arquivo = $request->arquivoSlide;
                        else
                            $request->conteudo = $request->conteudoSlide;
                        break;
                        break;
                    case 5:
                        $conteudo = $request->conteudoTransmissao;
                        break;
                    case 6:
                        if(isset($request->arquivoArquivo))
                            $request->arquivo = $request->arquivoArquivo;
                        else
                            $request->conteudo = $request->conteudoArquivo;
                        break;
                    case 7:
                        if($request->conteudoDissertativaDica == null)
                            $request->conteudoDissertativaDica = '';
                        if($request->conteudoDissertativaExplicacao == null)
                            $request->conteudoDissertativaExplicacao = '';

                        $conteudo = json_encode(['pergunta' => $request->conteudoDissertativa, 'dica' => $request->conteudoDissertativaDica, 'explicacao' => $request->conteudoDissertativaExplicacao]);
                        break;
                    case 8:
                        $conteudo = json_encode(['pergunta' => $request->conteudoQuiz, 'alternativas' => [ $request->conteudoQuizAlternativa1, $request->conteudoQuizAlternativa2, $request->conteudoQuizAlternativa3 ], 'correta' => $request->conteudoQuizAlternativaCorreta, 'dica' => $request->conteudoQuizDica, 'explicacao' => $request->conteudoQuizExplicacao]);
                        break;
                    case 9:
                        $conteudo = $request->conteudoProva;
                        break;
                    case 10:
                        $conteudo = $request->conteudoEntregavel;
                        break;
                    case 11:
                        if(isset($request->arquivoApostila))
                            $request->arquivo = $request->arquivoApostila;
                        else
                            $request->conteudo = $request->conteudoApostila;
                        break;

                    default:
                        $conteudo = $request->conteudo;
                        break;
                }

                if($request->tipo == 2 || $request->tipo == 3 || $request->tipo == 4 || $request->tipo == 6)
                {
                    if(isset($request->arquivo))
                    {
                        if($conteudoOriginal->conteudo != null)
                        {
                            if(\Storage::disk('local')->has('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudoOriginal->conteudo))
                            {
                                \Storage::disk('local')->delete('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudoOriginal->conteudo);
                            }
                        }

                        $originalName = mb_strtolower( $request->arquivo->getClientOriginalName(), 'utf-8' );

                        $fileExtension = \File::extension($request->arquivo->getClientOriginalName());
                        $newFileNameArquivo =  md5( $request->arquivo->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

                        $pathArquivo = $request->arquivo->storeAs('uploads/cursos/' . $idCurso . '/arquivos', $newFileNameArquivo, 'local');

                        if(!\Storage::disk('local')->put($pathArquivo, file_get_contents($request->arquivo)))
                        // if(!\Storage::disk('gcs')->put($pathArquivo, file_get_contents($request->arquivo)))
                        // if(!\Storage::disk('gcs')->put('uploads/cursos/' . $idCurso . '/arquivos/' . $newFileNameArquivo, file_get_contents($request->arquivo)))
                        {
                            \Session::flash('error', 'Não foi possível fazer upload de seu conteúdo!');
                        }
                        else
                        {
                            $conteudo = $newFileNameArquivo;
                        }
                    }
                    else
                    {
                        if($request->conteudo != "" && $request->conteudo != null)
                            $conteudo = $request->conteudo;
                        else
                            $conteudo = $conteudoOriginal->conteudo;
                    }
                }
                else if($request->tipo == 11)
                {
                    $conteudo = "index.html";
                }

                $conteudoOriginal->update([
                    'titulo' => $request->titulo,
                    'descricao' => $request->descricao,
                    'conteudo' => $conteudo,
                    'obrigatorio' => $request->obrigatorio,
                    'tempo' => $request->tempo,
                    'apoio' => $request->apoio,
                    'fonte' => $request->fonte,
                    'autores' => $request->autores,
                ]);

                if($request->tipo == 11)
                {
                    $tem_arquivo = isset($request->arquivoApostila) || isset($request->conteudoApostila);

                    $tem_conteudo = isset($request->conteudoApostila) ? ($request->conteudoApostila != null && $request->conteudoApostila != '') : false;

                    if($tem_arquivo && $tem_conteudo)
                    {
                        $zipperFile = \Zipper::make($request->arquivo);

                        $logFiles = $zipperFile->listFiles();

                        // dd($logFiles);

                        if(in_array("index.html", $logFiles) == false || in_array("index.js", $logFiles) == false)
                        {
                            $novo_conteudo->delete();

                            return redirect()->back()->withErrors("Conteúdo do zip inválido, por favor consulte as instruções de upload de apostilas!");
                        }

                        $zipperFile->extractTo(public_path('uploads') . '/apostilas/' . $novo_conteudo->id . '/');

                        if (!\Storage::disk('public_uploads')->has('apostilas/' . $novo_conteudo->id))
                        {
                            $novo_conteudo->delete();

                            return redirect()->back()->withErrors("Não foi possível extrair o conteúdo do zip, por favor envie sua aplicação novamente!");
                        }
                    }
                }

                return Redirect::route('gestao.curso-conteudo', ['idCurso' => $idCurso, 'aula' => $request->idAula])->with('message', 'Conteúdo atualizado com sucesso!');
            }
            else
            {
                return response()->json(['error' => 'Conteúdo não encontrado!']);
            }
        }
        else
        {
            return response()->json(['error' => 'Aula não encontrada!']);
        }

        return Redirect::back()->with('message', 'Aula atualizada com sucesso!');
    }

    public function reordenarConteudo($idCurso, $idAula, $idConteudo, $index)
    {
        if(Conteudo::where([['id', '=', $idConteudo], ['curso_id', '=', $idCurso], ['aula_id', '=', $idAula]])->first() != null)
        {
            $ordemAtual = Conteudo::where([['id', '=', $idConteudo], ['curso_id', '=', $idCurso], ['aula_id', '=', $idAula]])->first()->ordem;

            if(Conteudo::where([['ordem', '=', $index], ['curso_id', '=', $idCurso], ['aula_id', '=', $idAula]])->first() != null)
            {
                Conteudo::where([['ordem', '=', $index], ['curso_id', '=', $idCurso], ['aula_id', '=', $idAula]])->update([
                    'ordem' => $ordemAtual,
                ]);
            }

            Conteudo::where([['id', '=', $idConteudo], ['curso_id', '=', $idCurso], ['aula_id', '=', $idAula]])->update([
                'ordem' => $index
            ]);

            return response()->json(['success'=> 'Conteudo reordenado com sucesso!' . $idAula . '-' . $index]);
        }
        else
        {
            return response()->json(['error' => 'Conteudo não encontrado!']);
        }
    }

    public function postDuplicarConteudoCurso($idCurso, Request $request)
    {
        $exists_conteudo = Conteudo::where([['id', '=', $request->idConteudo]])->exists();

        $exists_conteudo_aula = ConteudoAula::where([['conteudo_id', '=', $request->idConteudo], ['curso_id', '=', $idCurso], ['aula_id', '=', $request->idAula]])->exists();

        if($exists_conteudo && $exists_conteudo_aula)
        {
            $new_conteudo = Conteudo::where([['id', '=', $request->idConteudo]])->first()->replicate();

            $new_conteudo->save();

            $new_conteudo_aula = ConteudoAula::where([['conteudo_id', '=', $request->idConteudo], ['curso_id', '=', $idCurso], ['aula_id', '=', $request->idAula]])->first()->replicate();

            $new_conteudo_aula->conteudo_id = $new_conteudo->id;

            // $newConteudo->id = Conteudo::where([['aula_id', '=', $request->idAula], ['curso_id', '=', $idCurso]])->max('id') + 1;

            //Duplicar arquivo do conteudo se aplicavel
            // if($request->tipo == 2 || $request->tipo == 3 || $request->tipo == 4 || $request->tipo == 6)
            // {
            //     $file = \Storage::disk('local')->get('uploads/cursos/' . $idCurso . '/arquivos/' . $newConteudo->conteudo);

            //     $originalName = mb_strtolower( $file->getClientOriginalName(), 'utf-8' );

            //     $fileExtension = \File::extension($file->getClientOriginalName());
            //     $newFileNameArquivo =  md5( $file->getClientOriginalName() . date("Y-m-d H:i:s") . time() ) . '.' . $fileExtension;

            //     $pathArquivo = $file->copy('uploads/cursos/' . $idCurso . '/arquivos', $newFileNameArquivo, 'local');

            //     if(!\Storage::disk('local')->copy($pathArquivo, file_get_contents($request->arquivo)))
            //     {
            //         \Session::flash('error', 'Não foi possível duplicar seu conteúdo!');
            //     }
            //     else
            //     {
            //         $conteudo = $newFileNameArquivo;
            //     }
            // }

            $new_conteudo_aula->save();

            \Session::flash('message', 'Conteúdo duplicado com sucesso!');
            return redirect()->route('gestao.curso-conteudo', ['idCurso' => $idCurso, 'aula' => $request->idAula]);

            // return Redirect::back()->with('message', 'Conteúdo duplicado com sucesso!');
        }
        else
        {
            return Redirect::back()->withErrors(['Conteúdo não encontrado!']);
        }
    }

    public function postExcluirConteudoCurso($idCurso, Request $request)
    {
        if(ConteudoAula::where([['conteudo_id', '=', $request->idConteudo], ['curso_id', '=', $idCurso], ['aula_id', '=', $request->idAula]])->first() != null)
        {
            $conteudo = ConteudoAula::where([['conteudo_id', '=', $request->idConteudo], ['curso_id', '=', $idCurso], ['aula_id', '=', $request->idAula]])->first();

            // if($conteudo->tipo == 2 || $conteudo->tipo == 3 || $conteudo->tipo == 4 || $conteudo->tipo == 6)
            // {
            //     if($conteudo->conteudo != null)
            //     {
            //         if(\Storage::disk('local')->has('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudo->conteudo))
            //         {
            //             \Storage::disk('local')->delete('uploads/cursos/' . $idCurso . '/arquivos/' . $conteudo->conteudo);
            //         }
            //     }
            // }

            ConteudoAula::where([['conteudo_id', '=', $request->idConteudo], ['curso_id', '=', $idCurso], ['aula_id', '=', $request->idAula]])->delete();

            \Session::flash('success', 'Conteúdo excluido com sucesso!');

            return redirect()->route('gestao.curso-conteudo', ['idCurso' => $idCurso, 'aula' => $request->idAula]);

            // return Redirect::back()->with('message', 'Conteúdo excluido com sucesso!');
        }
        else
        {
            return Redirect::back()->withErrors(['Conteúdo não encontrado!']);
        }
    }



    public function rankingProfessores()
    {
        $userLogged = Auth::user(); //PEGA USUARIO LOGADO

        /* RANKING GERAL */
        $professoresGeral = DB::table('users')
            ->leftJoin('avaliacoes_instrutor', 'users.id', '=', 'avaliacoes_instrutor.instrutor_id')
            ->select(DB::raw('users.id as id, users.name as nome, sum(avaliacoes_instrutor.avaliacao) as pontos'))
            ->where('users.permissao', '=', 'P')
            ->groupBy('instrutor_id')
            ->orderBy('pontos', 'DESC')
            ->get();

        $professorIndexGet = $professoresGeral->search(function ($user) {
            return $user->id === Auth::id();
        });

        $professorIndex = ($professorIndexGet !== false) ? $professorIndexGet + 1 : $professorIndexGet;
        /* */

        /* RANKING DE ESCOLAS */
        $escolas = DB::table('escolas')
            ->leftJoin('avaliacoes_escola', 'escolas.id', '=', 'avaliacoes_escola.escola_id')
            ->select(DB::raw('escolas.id as id, escolas.titulo as titulo, sum(avaliacoes_escola.avaliacao) as pontos'))
            ->groupBy('escola_id')
            ->orderBy('pontos', 'DESC')
            ->get();

        $escolaUserIndexGet = $escolas->search(function ($escola) {
            return $escola->id === Auth::user()->escola_id;
        });

        $escolaIndex = ($escolaUserIndexGet !== false) ? $escolaUserIndexGet + 1 : $escolaUserIndexGet;
        /* */

        return view('gestao.ranking-professores', compact('userLogged', 'professoresGeral', 'professorIndex', 'escolas', 'escolaIndex'));
    }

}
