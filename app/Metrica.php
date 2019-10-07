<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Metrica extends Model
{
    //Preenchiveis
    protected $fillable = [
        'id',
        'user_id',
        'titulo',
        'descricao',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao' => '',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function aluno_turma()
    {
        return $this->belongsTo('App\AlunoTurma', 'user_id', 'user_id');
    }

}
