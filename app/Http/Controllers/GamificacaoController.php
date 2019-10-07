<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;
use App\Entities\GamificacaoUsuario;

use App\Entities\ConfiguracoesGamificacao\ConfiguracoesGamificacao;

class GamificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuracoes_gamificacao = ConfiguracoesGamificacao::where([['user_id', '=', Auth::user()->id], ['escola_id', '=', Auth::user()->escola_id]])->first();

        if($configuracoes_gamificacao == null)
        {
            $configuracoes_gamificacao = ConfiguracoesGamificacao::create([
                'user_id' => Auth::user()->id,
                'escola_id' => Auth::user()->escola_id,
                'login_ativo' => false,
                'login_xp' => 25,
                'conclusao_conteudo_ativo' => false,
                'conclusao_conteudo_xp' => 10,
                'conclusao_aula_ativo' => false,
                'conclusao_aula_xp' => 50,
                'conclusao_curso_ativo' => false,
                'conclusao_curso_xp' => 100,
                'conclusao_teste_ativo' => false,
                'conclusao_teste_xp' => 30,
                'topico_ativo' => false,
                'topico_xp' => 15,
                'comentario_ativo' => false,
                'comentario_xp' => 5,
                'level_up_curso_ativo' => false,
                'level_up_curso' => 5,
                'level_up_conquista_ativo' => false,
                'level_up_conquista' => 15,
                'formula_level_ativo' => false,
                'formula_level' => null,
            ]);
        }

        return view('pages.gestao.gamificacao.index')->with( compact('configuracoes_gamificacao') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $request->request->add(['user_id' => Auth::user()->id]);

        $request->request->add(['escola_id' => Auth::user()->escola_id]);

        foreach ($request->all() as $key => $value) {
            if($value == 'on')
            {
                $request[$key] = true;
            }
        }

        if($request->has('login_ativo') == false)
        {
            $request->request->add(['login_ativo' => false]);
        }
        if($request->has('conclusao_conteudo_ativo') == false)
        {
            $request->request->add(['conclusao_conteudo_ativo' => false]);
        }
        if($request->has('conclusao_aula_ativo') == false)
        {
            $request->request->add(['conclusao_aula_ativo' => false]);
        }
        if($request->has('conclusao_curso_ativo') == false)
        {
            $request->request->add(['conclusao_curso_ativo' => false]);
        }
        if($request->has('conclusao_teste_ativo') == false)
        {
            $request->request->add(['conclusao_teste_ativo' => false]);
        }
        if($request->has('topico_ativo') == false)
        {
            $request->request->add(['topico_ativo' => false]);
        }
        if($request->has('comentario_ativo') == false)
        {
            $request->request->add(['comentario_ativo' => false]);
        }
        if($request->has('level_up_curso_ativo') == false)
        {
            $request->request->add(['level_up_curso_ativo' => false]);
        }
        if($request->has('level_up_conquista_ativo') == false)
        {
            $request->request->add(['level_up_conquista_ativo' => false]);
        }
        if($request->has('formula_level_ativo') == false)
        {
            $request->request->add(['formula_level_ativo' => false]);
        }

        // dd($request->all());

        ConfiguracoesGamificacao::updateOrCreate(
            ['user_id' => Auth::user()->id, 'escola_id' => Auth::user()->escola_id],
            $request->all()
        );

        // ConfiguracoesGamificacao::create($request->all());

        return redirect()->back()->with('success', 'Configurações de gamificação salvas com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // ConfiguracoesGamificacao::create([
        //     'user_id' => Auth::user()->id,
        //     'escola_id' => Auth::user()->escola_id,
        //     'login_ativo' => $request->login_ativo,
        //     'login_xp' => $request->login_xp,
        //     'conclusao_aula_ativo' => $request->conclusao_aula_ativo,
        //     'conclusao_aula_xp' => $request->conclusao_aula_xp,
        //     'conclusao_curso_ativo' => $request->conclusao_curso_ativo,
        //     'conclusao_curso_xp' => $request->conclusao_curso_xp,
        //     'conclusao_teste_ativo' => $request->conclusao_teste_ativo,
        //     'conclusao_teste_xp' => $request->conclusao_teste_xp,
        //     'topico_ativo' => $request->topico_ativo,
        //     'topico_xp' => $request->topico_xp,
        //     'comentario_ativo' => $request->comentario_ativo,
        //     'comentario_xp' => $request->comentario_xp,
        //     'level_up_curso_ativo' => $request->level_up_curso_ativo,
        //     'level_up_curso' => $request->level_up_curso,
        //     'level_up_conquista_ativo' => $request->level_up_conquista_ativo,
        //     'level_up_conquista' => $request->level_up_conquista,
        //     'formula_level' => $request->formula_level,
        // ]);

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
