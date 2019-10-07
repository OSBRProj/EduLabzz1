<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class CodigoTransmissao extends Model
{
    protected $table = 'codigo_transmissao';

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'token',
        'referencia_id',
        'tipo',
        'status',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        // 'tipo' => 1,
        'status' => 1,
    ];

    public function aplicacao()
    {
        return $this->belongsTo('App\Aplicacao', 'referencia_id');
    }

    public function conteudo()
    {
        return $this->belongsTo('App\Conteudo', 'referencia_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
