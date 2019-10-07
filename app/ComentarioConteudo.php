<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ComentarioConteudo extends Model
{
    protected $table = 'comentarios_conteudo';
    
    //Preenchiveis
    protected $fillable = [
        'user_id',
        'curso_id',
        'aula_id',
        'conteudo_id',
        'comentario',
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