<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class LiberacaoAplicacaoEscola extends Model
{
    protected $table = 'liberacao_aplicacao_escola';

    //Preenchiveis
    protected $fillable = [
        'aplicacao_id',
        'escola_id',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
    ];

    public function aplicacao()
    {
        return $this->belongsTo('App\Aplicacao');
    }

    public function escola()
    {
        return $this->belongsTo('App\Escola');
    }

}
