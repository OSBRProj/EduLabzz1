<?php

namespace App\Services;

use Auth;

use App\User;
use App\Notificacao;

use App\Entities\GamificacaoUsuario\GamificacaoUsuario;

use App\Entities\ConfiguracoesGamificacao\ConfiguracoesGamificacao;

class GamificacaoService {


    //
    // Gatilhos de incremento da plataforma
    //

    //
    // loginIncrement()
    // conteudoCompletoIncrement
    // aulaConcluidaIncrement()
    // cursoConcluidoIncrement()
    // testeConcluidaIncrement()
    // topicoCriadoIncrement()
    // comentarioEnviadoIncrement()
    //

    public static function loginIncrement()
    {
        $configuracoes_gamificacao = ConfiguracoesGamificacao::where([['escola_id', '=', Auth::user()->escola_id]])->first();

        // dd($configuracoes_gamificacao);

        if($configuracoes_gamificacao == null)
        {
            return true;
        }


        if($configuracoes_gamificacao->login_ativo == true)
        {
            self::incrementUserXP($configuracoes_gamificacao->login_xp);
        }

        return true;
    }

    public static function conteudoCompletoIncrement()
    {
        $configuracoes_gamificacao = ConfiguracoesGamificacao::where([['escola_id', '=', Auth::user()->escola_id]])->first();

        if($configuracoes_gamificacao == null)
        {
            return true;
        }

        if($configuracoes_gamificacao->conclusao_conteudo_ativo == true)
        {
            self::incrementUserXP($configuracoes_gamificacao->conclusao_conteudo_xp);
        }

        return true;
    }

    public static function aulaConcluidaIncrement()
    {
        $configuracoes_gamificacao = ConfiguracoesGamificacao::where([['escola_id', '=', Auth::user()->escola_id]])->first();

        if($configuracoes_gamificacao == null)
        {
            return true;
        }

        if($configuracoes_gamificacao->conclusao_aula_ativo == true)
        {
            self::incrementUserXP($configuracoes_gamificacao->conclusao_aula_xp);
        }

        return true;
    }

    public static function cursoConcluidoIncrement()
    {
        $configuracoes_gamificacao = ConfiguracoesGamificacao::where([['escola_id', '=', Auth::user()->escola_id]])->first();

        if($configuracoes_gamificacao == null)
        {
            return true;
        }

        if($configuracoes_gamificacao->conclusao_curso_ativo == true)
        {
            self::incrementUserXP($configuracoes_gamificacao->conclusao_curso_xp);
        }

        return true;
    }

    public static function testeConcluidaIncrement()
    {
        $configuracoes_gamificacao = ConfiguracoesGamificacao::where([['escola_id', '=', Auth::user()->escola_id]])->first();

        if($configuracoes_gamificacao == null)
        {
            return true;
        }

        if($configuracoes_gamificacao->conclusao_teste_ativo == true)
        {
            self::incrementUserXP($configuracoes_gamificacao->conclusao_teste_xp);
        }

        return true;
    }

    public static function topicoCriadoIncrement()
    {
        $configuracoes_gamificacao = ConfiguracoesGamificacao::where([['escola_id', '=', Auth::user()->escola_id]])->first();

        if($configuracoes_gamificacao == null)
        {
            return true;
        }

        if($configuracoes_gamificacao->topico_ativo == true)
        {
            self::incrementUserXP($configuracoes_gamificacao->topico_xp);
        }

        return true;
    }

    public static function comentarioEnviadoIncrement()
    {
        $configuracoes_gamificacao = ConfiguracoesGamificacao::where([['escola_id', '=', Auth::user()->escola_id]])->first();

        if($configuracoes_gamificacao == null)
        {
            return true;
        }

        if($configuracoes_gamificacao->comentario_ativo == true)
        {
            self::incrementUserXP($configuracoes_gamificacao->comentario_xp);
        }

        return true;
    }

    //
    // Helper functions
    //

    public static function incrementUserXP($amount)
    {
        if(($amount > 0) == false)
        {
            return null;
        }
        else if(Auth::check() == false)
        {
            return null;
        }

        $gamificacao_usuario = GamificacaoUsuario::where('user_id', Auth::user()->id)->first();

        // $gamificacao_usuario->delete();

        // dd($gamificacao_usuario);

        if ($gamificacao_usuario == null)
        {
            $gamificacao_usuario = GamificacaoUsuario::create(['user_id' => Auth::user()->id, 'xp' => 0]);
        }

        if((Auth::user()->gamificacao->xp_reseted + $amount) >= Auth::user()->gamificacao->next_level_xp(true))
        {
            $level_up = true;
        }
        else
        {
            $level_up = false;
        }

        $new_level = Auth::user()->gamificacao->getLevel( Auth::user()->gamificacao->xp + $amount );

        if($level_up)
        {
            Notificacao::create([
                'user_id' => Auth::user()->id,
                'titulo' => "Parabéns!",
                'descricao' => "Você alcançou o nível " . ( $new_level ),
                'tipo' => 2,
            ]);

            $gamificacao_usuario->update([
                "notificado_level_up" => false
            ]);
        }

        $gamificacao_usuario->update([
            'xp' => ($gamificacao_usuario->xp + $amount)
        ]);

        // return Auth::user()->gamificacao->level_atual() . ', ' . $new_level . ', ' .  Auth::user()->gamificacao->xp . ', ' .  $amount . '<br>' . Auth::user()->gamificacao->getLevel( (Auth::user()->gamificacao->xp + $amount) );

        return $gamificacao_usuario;
    }

    public static function showLevelUpNotification()
    {
        if(Auth::check() == false)
        {
            return null;
        }

        $gamificacao_usuario = GamificacaoUsuario::where('user_id', Auth::user()->id)->first();

        if ($gamificacao_usuario == null)
        {
            $gamificacao_usuario = GamificacaoUsuario::create(['user_id' => Auth::user()->id, 'xp' => 0]);
        }

        if($gamificacao_usuario->notificado_level_up == false)
        {
           $gamificacao_usuario->update([
                "notificado_level_up" => true
            ]);

            $new_level = $gamificacao_usuario->level_atual();

            return view('components.gamificacao.level-up-popup')->with( compact('new_level') );
        }
        else
        {
            return null;
        }

    }

}
