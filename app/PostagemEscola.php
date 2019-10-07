<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class PostagemEscola extends Model
{
    protected $table = 'postagem_escola';

    //Preenchiveis
    protected $fillable = [
        'id',
        'escola_id',
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
        return $this->hasMany('App\ComentarioPostagemEscola', 'postagem_id');
    }

    public function escola()
    {
        return $this->belongsTo('App\Escola', 'escola_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
