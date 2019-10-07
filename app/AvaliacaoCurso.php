<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class AvaliacaoCurso extends Model
{
    protected $table = 'avaliacoes_curso';
    
    //Preenchiveis
    protected $fillable = [
        'user_id',
        'curso_id',
        'avaliacao',
        'descricao',
    ];    

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao' => '',
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