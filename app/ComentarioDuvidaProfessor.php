<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ComentarioDuvidaProfessor extends Model
{
    protected $table = 'comentario_duvida_professor';

    //Preenchiveis
    protected $fillable = [
        'duvida_id',
        'user_id',
        'conteudo',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
    ];

    public function duvida()
    {
        return $this->belongsTo('App\DuvidaProfessor', 'duvida_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
