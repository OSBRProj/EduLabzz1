<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class PostagemTurma extends Model
{
    protected $table = 'postagem_turma';

    //Preenchiveis
    protected $fillable = [
        'id',
        'turma_id',
        'user_id',
        'conteudo',
        'arquivo',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [

    ];

    public function comentarios()
    {
        return $this->hasMany('App\ComentarioPostagemTurma', 'postagem_id');
    }

    public function turma()
    {
        return $this->belongsTo('App\Turma', 'turma_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
