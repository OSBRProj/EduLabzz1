<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_numeric($idCurso))
        {
            if(Curso::find($idCurso) != null)
            {
                $curso = Curso::with('aulas', 'user', 'avaliacoes_user', 'topicos')->where([['id', '=', $idCurso]])->first();
                // $curso = Curso::with('aulas', 'user', 'avaliacoes_user')->where([['escola_id', '=', $escola->id], ['id', '=', $idCurso]])->first();
            }
        }
        else
        {
            // Verificação comentada, apenas usada se o titulo for codificado com traços ao inves de espaços
            // if(Curso::where('titulo', '=', str_replace('-', ' ', $idCurso))->first() != null)
            if(Curso::where('titulo', '=', $idCurso)->first() != null)
            {
                $curso = Curso::with('aulas', 'user', 'avaliacoes_user', 'topicos')->where([['escola_id', '=', $escola->id], ['titulo', '=', $idCurso]])->first();
            }
            elseif(is_numeric( substr(strrchr($idCurso, "-"), 1) ))
            {
                if(Curso::find(substr(strrchr($idCurso, "-"), 1)) != null)
                {
                    $temp = Curso::find(substr(strrchr($idCurso, "-"), 1));

                    $tempTitulo = mb_strtolower($temp->titulo . '-' . $temp->id, 'utf-8');

                    if($tempTitulo == $idCurso)
                    {
                        $curso = Curso::find(substr(strrchr($idCurso, "-"), 1));
                    }
                }
            }
        }

        // dd(count(array_filter(Session::get('carrinho'), function($k) use ($curso) { return ($k->tipo == 2 && $k->id == $curso->id); })));

        if(isset($curso) ? ($curso == null) : (true))
        {
            Session::flash('error', "Curso não encontrado!");

            return redirect()->route('catalogo');
        }

        if($curso->status != 1)
        {
            if(Auth::check() ? (strtolower(Auth::user()->permissao) != "z" && $curso->user_id != Auth::user()->id) : true)
            {
                Session::flash('error', "Curso não encontrado!");

                return redirect()->route('catalogo');
            }
            else
            {
                Session::flash('previewMode', true);
            }
        }

        if($curso->senha != "" && $curso->senha != null)
        {
            if(Session::has('senhaCurso'. $curso->id))
            {
                if(Session::get('senhaCurso'. $curso->id) != $curso->senha)
                {
                    Session::forget('senhaCurso'. $curso->id);
                    return Redirect::back()->withErrors(['Senha do curso inválida!']);
                }
            }
            else
            {
                // if($curso->escola_id != 1)
                // {
                //     // return Redirect::route('curso.trancado', ['escola_id' => $curso->escola_id, 'idCurso' => $curso->id]);
                // }
                // else
                {
                    return Redirect::route('curso.trancado', ['idCurso' => $curso->id]);
                }
            }
        }

        $curso->duracao = 0;

        foreach ($curso->aulas as $key => $aula)
        {
            // $aula->conteudos = Conteudo::where([['curso_id', '=', $curso->id], ['aula_id', '=', $aula->id]])->orderBy('ordem', 'asc')->get();
            $aula->conteudos = Conteudo::
            with('conteudo_aula')
            ->whereHas('conteudo_aula', function ($query) use ($curso, $aula) {
                $query->where([['curso_id', '=', $curso->id], ['aula_id', '=', $aula->id]]);
            })
            // ->orderBy('ordem', 'asc')
            ->get()
            ->sortBy('conteudo_aula.ordem');

            $aula->conteudos = Conteudo::detalhado($aula->conteudos);

            $aula->duracao = Conteudo::
            whereHas('conteudo_aula', function ($query) use ($curso, $aula) {
                $query->where([['curso_id', '=', $curso->id], ['aula_id', '=', $aula->id]]);
            })
            ->sum('duracao');

            if($aula->duracao == 0)
            {
                $aula->duracao = count($aula->conteudos) * 120;
            }


            $curso->duracao += $aula->duracao;

            if($aula->duracao > 60)
            {
                $horas = floor($aula->duracao / 60);
                $minutos = number_format((($aula->duracao / 60) - $horas) * 60, 0);
                $aula->duracao = $horas . ':' . ($minutos < 10 ? '0' . $minutos : $minutos);
            }
            else
            {
                $aula->duracao = '00:' . ($aula->duracao < 10 ? '0' . $aula->duracao : $aula->duracao);
            }
        }

        if($curso->duracao > 60)
        {
            $horas = floor($curso->duracao / 60);
            $minutos = number_format((($curso->duracao / 60) - $horas) * 60, 0);
            $curso->duracao = $horas . ':' . ($minutos < 10 ? '0' . $minutos : $minutos);
        }
        else
        {
            $curso->duracao = '00:' . ($curso->duracao < 10 ? '0' . $curso->duracao : $curso->duracao);
        }

        if(AvaliacaoCurso::where('curso_id', '=', $curso->id)->avg('avaliacao') > 0)
            $curso->avaliacao = AvaliacaoCurso::where('curso_id', '=', $curso->id)->avg('avaliacao');
        else
            $curso->avaliacao = 5;

        if(AvaliacaoInstrutor::where('instrutor_id', '=', $curso->user_id)->avg('avaliacao') > 0)
            $curso->user->avaliacao = AvaliacaoInstrutor::where('instrutor_id', '=', $curso->user_id)->avg('avaliacao');
        else
            $curso->user->avaliacao = 5;

        if(AvaliacaoEscola::where('escola_id', '=', $curso->escola_id)->avg('avaliacao') > 0)
            $curso->avaliacao_escola = AvaliacaoEscola::where('escola_id', '=', $curso->escola_id)->avg('avaliacao');
        else
            $curso->avaliacao_escola = 5;

        Metrica::create([
            'user_id' => Auth::check() ? Auth::user()->id : 0,
            'titulo' => 'Visualização curso - ' . $curso->id
        ]);

        $curso->visualizacoes = Metrica::where('titulo', '=', 'Visualização curso - ' . $curso->id)->count();

        $matricula = Auth::check() ? Matricula::where([['user_id', '=', Auth::user()->id], ['curso_id', '=', $curso->id]])->first() : null;

        $curso->transacoes = null;

        $curso->statusPagamento = null;

        if(Auth::check())
        {
            $curso->transacoes = collect();

            foreach (ProdutoTransacao::where([['user_id', '=', Auth::user()->id], ['produto_id', '=', $curso->id]])->get() as $produto)
            {
                if(Transacao::where('referencia_id', $produto->transacao_id)->first() != null)
                {
                    $curso->transacoes->push( Transacao::where('referencia_id', $produto->transacao_id)->first() );
                }
            }

            // dd(ProdutoTransacao::where([['user_id', '=', Auth::user()->id], ['produto_id', '=', $curso->id]])->get());

            $curso->transacoes = $curso->transacoes->unique(function ($item) {
                return $item->id;
            });

            if(count($curso->transacoes) > 0)
            {
                $curso->statusPagamento = $curso->transacoes[0]->status;
            }

            foreach ($curso->transacoes as $transacao)
            {
                if($transacao->status == 3 || $transacao->status == 4)
                {
                    $curso->statusPagamento = $transacao->status;
                    break;
                }
            }
        }

        // dd($curso->avaliacoes_user[0]->user->name);
        // dd($curso);

        // dd($curso->transacoes);
        // dd($curso->topicos);

        return response()->json(["data" => ["curso" => $curso, "matricula" => $matricula]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
