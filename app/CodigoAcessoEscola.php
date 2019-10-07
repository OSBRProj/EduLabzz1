<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class CodigoAcessoEscola extends Model
{
    protected $table = 'codigo_acesso_escola';

    //Preenchiveis
    protected $fillable = [
        'escola_id',
        'turma_id',
        'codigo',
        'aluno_id',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [

    ];

    public function escola()
    {
        return $this->belongsTo('App\Escola');
    }

    public function turma()
    {
        return $this->belongsTo('App\Turma');
    }

    public function aluno()
    {
        return $this->belongsTo('App\User', 'aluno_id');
    }

}
