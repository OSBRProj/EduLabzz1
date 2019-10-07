<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ComentarioPostagemGestaoEscola extends Model
{
    protected $table = 'comentario_postagem_gestao_escola';

    //Preenchiveis
    protected $fillable = [
        'postagem_id',
        'user_id',
        'conteudo',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
    ];

    public function postagem()
    {
        return $this->belongsTo('App\Postagem');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
