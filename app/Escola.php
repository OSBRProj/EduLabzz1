<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Escola extends Model
{
    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'capa',
        'postagem_aberta',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao' => '',
        'capa'      => '',
        'postagem_aberta' => 1,
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function usuarios()
    {
        return $this->hasMany('App\User', 'user_id');
    }

    public function alunos()
    {
        return $this->hasMany('App\User', 'escola_id');
    }

    public function alunos_exp()
    {
        return $this->hasMany('App\User', 'escola_id')->with('gamificacao');
    }

    public function postagens()
    {
        return $this->hasMany('App\PostagemEscola', 'escola_id')->orderBy('created_at', 'desc');
    }

    public function postagens_comentarios()
    {
        return $this->hasMany('App\PostagemEscola', 'escola_id')->with('user', 'comentarios')->orderBy('created_at', 'desc');
    }

    public function postagens_gestao()
    {
        return $this->hasMany('App\PostagemGestaoEscola', 'escola_id')->orderBy('created_at', 'desc');
    }

    public function postagens_gestao_comentarios()
    {
        return $this->hasMany('App\PostagemGestaoEscola', 'escola_id')->with('user', 'comentarios')->orderBy('created_at', 'desc');
    }

    public function avaliacoes()
    {
        return $this->hasMany('App\AvaliacaoEscola', 'escola_id');
    }

    public function avaliacoes_user()
    {
        return $this->hasMany('App\AvaliacaoEscola', 'escola_id')->with('user');
    }

}
