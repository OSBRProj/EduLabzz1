<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class LiberacaoAplicacaoUser extends Model
{
    protected $table = 'liberacao_aplicacao_user';

    //Preenchiveis
    protected $fillable = [
        'aplicacao_id',
        'user_id',
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
