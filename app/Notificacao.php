<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Notificacao extends Model
{
    protected $table = 'notificacoes';

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'tipo',
        'link',
        'lida',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao' => '',
        'tipo' => 2,
        'link' => '',
        'lida' => 0,
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
