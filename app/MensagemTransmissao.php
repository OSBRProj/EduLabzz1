<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class MensagemTransmissao extends Model
{
    protected $table = 'mensagem_transmissao';
    
    //Preenchiveis
    protected $fillable = [
        'user_id',
        'curso_id',
        'aula_id',
        'conteudo_id',
        'mensagem',
    ];    

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
    ];

    public function curso()
    {
        return $this->belongsTo('App\Curso');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}