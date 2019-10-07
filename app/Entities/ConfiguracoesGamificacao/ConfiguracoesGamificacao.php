<?php

namespace App\Entities\ConfiguracoesGamificacao;

use App\User;

use Illuminate\Database\Eloquent\Model;

class ConfiguracoesGamificacao extends Model
{
    protected $table = "configuracoes_gamificacao";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'escola_id',
        'login_ativo',
        'login_xp',
        'conclusao_conteudo_ativo',
        'conclusao_conteudo_xp',
        'conclusao_aula_ativo',
        'conclusao_aula_xp',
        'conclusao_curso_ativo',
        'conclusao_curso_xp',
        'conclusao_teste_ativo',
        'conclusao_teste_xp',
        'topico_ativo',
        'topico_xp',
        'comentario_ativo',
        'comentario_xp',
        'level_up_curso_ativo',
        'level_up_curso',
        'level_up_conquista_ativo',
        'level_up_conquista',
        'formula_level_ativo',
        'formula_level',
    ];

    protected $attributes = [
        'login_ativo' => false,
        'conclusao_conteudo_ativo' => false,
        'conclusao_aula_ativo' => false,
        'conclusao_curso_ativo' => false,
        'conclusao_teste_ativo' => false,
        'topico_ativo' => false,
        'comentario_ativo' => false,
        'level_up_curso_ativo' => false,
        'level_up_conquista_ativo' => false,
        'formula_level_ativo' => false,
    ];

    protected $casts = [
        'login_ativo' => 'boolean',
        'conclusao_conteudo_ativo' => 'boolean',
        'conclusao_aula_ativo' => 'boolean',
        'conclusao_curso_ativo' => 'boolean',
        'conclusao_teste_ativo' => 'boolean',
        'topico_ativo' => 'boolean',
        'comentario_ativo' => 'boolean',
        'level_up_curso_ativo' => 'boolean',
        'level_up_conquista_ativo' => 'boolean',
        'formula_level_ativo' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function escola()
    {
        return $this->belongsTo('AppEscola', 'user_id');
    }

}
