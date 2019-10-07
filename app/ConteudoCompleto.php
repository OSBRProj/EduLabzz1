<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

use Carbon\Carbon;

class ConteudoCompleto extends Model
{    
    protected $table = 'conteudo_completo';

    //Preenchiveis
    protected $fillable = [
        'id',
        'curso_id',
        'aula_id',
        'conteudo_id',
        'user_id',
        'resposta',
        'correta',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'resposta' => null,
        'correta' => null
    ];

    public function curso()
    {
        return $this->belongsTo('App\Curso', 'curso_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
