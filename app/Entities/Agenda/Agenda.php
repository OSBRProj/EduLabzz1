<?php

namespace App\Entities\Agenda;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agendas';
    
    //Preenchiveis
    protected $fillable = [
        'data_inicial',
        'data_final',
        'titulo',
        'descricao',
        'cor',
        'user_id'
    ];
}
