<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionalidade extends Model
{
    protected $table = 'funcionalidades';

    //Preenchiveis
    protected $fillable = [
        'id',
        'descricao',
        'codigo',
    ];
}
