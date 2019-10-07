<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class AvaliacaoConteudo extends Model
{
    protected $table = 'avaliacoes_conteudo';

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'conteudo_id',
        'avaliacao',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'avaliacao' => 0,
    ];

    public function conteudo()
    {
        return $this->belongsTo('App\Conteudo');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
