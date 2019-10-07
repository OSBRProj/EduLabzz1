<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class AvaliacaoEscola extends Model
{
    protected $table = 'avaliacoes_escola';

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'escola_id',
        'avaliacao',
        'descricao',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao' => '',
    ];

    public function escola()
    {
        return $this->belongsTo('App\Escola');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
