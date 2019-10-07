<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ComentarioTopicoCurso extends Model
{
    protected $table = 'comentario_topico_curso';

    //Preenchiveis
    protected $fillable = [
        'topico_curso_id',
        'user_id',
        'conteudo',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
    ];

    public function topico()
    {
        return $this->belongsTo('App\TopicoCurso', 'topico_curso_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
