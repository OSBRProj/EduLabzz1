<?php

namespace App\Entities\TesteNivelamento;

use Illuminate\Database\Eloquent\Model;

class TesteNivelamentoDirecionamento extends Model
{
    protected $table = "teste_nivelamento_direcionamento";
    
    //Preenchiveis
    protected $fillable = [
        'teste_id',
        'regra',
        'pontuacao',
        'direcionamento'
    ];
}
