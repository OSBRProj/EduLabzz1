<?php

namespace App\Entities\Anotacao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Anotacao extends Model
{
    protected $table = 'anotacoes';

    //Preenchiveis
    protected $fillable = [
        'id',
        'user_id',
        'conteudo_id',
        'pagina',
        'trecho',
        'anotacao',
        'pos_y',
        'pos_x',
        'start',
        'end',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'anotacao' => '',
        'pos_y' => 0,
        'pos_x' => 0,
        'start' => 0,
        'end' => 0,
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
