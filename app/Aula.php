<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Awobaz\Compoships\Database\Eloquent\Model;

use Illuminate\Support\Facades\Input;

class Aula extends Model
{
    // use \Awobaz\Compoships\Compoships;

    //Preenchiveis
    protected $fillable = [
        'id',
        'curso_id',
        'user_id',
        'titulo',
        'descricao',
        'duracao',
        'requisito',
        'requisito_id',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao' => '',
        'duracao' => 0,
        'requisito' => '',
        'requisito_id' => 0,
    ];

    public static function withConteudos($aula)
    {
        return ConteudoAula::
        with('conteudo')
        ->where([['curso_id', '=', $aula->curso_id], ['aula_id', '=', $aula->id]])
        ->whereHas('conteudo')
        ->get()
        ->sortBy('ordem');

        // return Conteudo::
        // with('conteudo_aula')
        // ->whereHas('conteudo_aula', function ($query) use ($aula) {
        //     $query->where([['curso_id', '=', $aula->curso_id], ['aula_id', '=', $aula->id]]);
        // })
        // ->get()
        // ->sortBy('conteudo_aula.ordem');
    }

    public function curso()
    {
        return $this->belongsTo('App\Curso', 'curso_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
