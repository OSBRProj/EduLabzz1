<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roteiro extends Model
{
    protected $table = 'roteiros';

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo'
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

    public function topicos()
    {
        return $this->hasMany('App\RoteiroTopico')->orderBy('id', 'asc');
    }

}
