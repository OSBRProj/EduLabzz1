<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Turma extends Model
{
    //Preenchiveis
    protected $fillable = [
        'id',
        'user_id',
        'titulo',
        'descricao',
        'codigo_convite',
        'postagem_aberta',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao'       => '',
        'codigo_convite'  => '',
        'postagem_aberta' => 1,
    ];

    public function postagens()
    {
        return $this->hasMany('App\PostagemTurma', 'turma_id')->with('user')->orderBy('created_at', 'desc');
    }

    public function postagens_comentarios()
    {
        return $this->hasMany('App\PostagemTurma', 'turma_id')->with('user', 'comentarios')->orderBy('created_at', 'desc');
    }

    public function alunos()
    {
        return $this->hasMany('App\AlunoTurma', 'turma_id');
    }

    public function alunos_user()
    {
        return $this->hasMany('App\AlunoTurma', 'turma_id')->with('user');
    }

    public function escola()
    {
        return $this->belongsTo('App\Escola', 'escola_id')->withDefault([
            'id' => "1",
            'titulo' => "Jean Piaget"
        ]);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function professor()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
