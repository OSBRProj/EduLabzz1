<?php

namespace App\Entities\MarcadorPagina;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class MarcadorPagina extends Model
{
    protected $table = 'marcador_pagina';

    //Preenchiveis
    protected $fillable = [
        'id',
        'conteudo_id',
        'user_id',
        'pagina',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
    ];

    public function conteudo()
    {
        return $this->belongsTo('App\Conteudo', 'conteudo_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
