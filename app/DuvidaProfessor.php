<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class DuvidaProfessor extends Model
{
    protected $table = 'duvida_professor';

    //Preenchiveis
    protected $fillable = [
        'professor_id',
        'user_id',
        'titulo',
        'descricao',
        'status'
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao' => '',
        'status' => 0
    ];

    public function comentarios()
    {
        return $this->hasMany('App\ComentarioDuvidaProfessor', 'duvida_id');
    }

    public function professor()
    {
        return $this->belongsTo('App\User', 'professor_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
