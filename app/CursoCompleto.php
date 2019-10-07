<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class CursoCompleto extends Model
{    
    protected $table = 'curso_completo';

    //Preenchiveis
    protected $fillable = [
        'curso_id',
        'user_id',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function curso()
    {
        return $this->belongsTo('App\Curso', 'curso_id');
    }

}
