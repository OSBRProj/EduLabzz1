<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class AlunoTurma extends Model
{
    protected $table = 'aluno_turma';

    //Preenchiveis
    protected $fillable = [
        'turma_id',
        'user_id',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [

    ];

    public function turma_professor()
    {
        return $this->belongsTo('App\Turma', 'turma_id')->with('professor');
    }
    
    public function gamificacao()
    {
        return $this->hasMany('App\Entities\GamificacaoUsuario\GamificacaoUsuario', 'user_id');
    }

    public function turma()
    {
        return $this->belongsTo('App\Turma', 'turma_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
