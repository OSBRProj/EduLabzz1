<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Matricula extends Model
{
    //Preenchiveis
    protected $fillable = [
        'user_id',
        'curso_id',
        'data_validade',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
    ];

    public function curso()
    {
        return $this->belongsTo('App\Curso', 'curso_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
