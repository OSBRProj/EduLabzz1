<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class EnderecoUser extends Model
{
    protected $table = 'endereco_user';

    protected $primaryKey = 'user_id';

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'cep',
        'uf',
        'cidade',
        'bairro',
        'logradouro',
        'numero',
        'complemento',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'cidade' => '',
        'bairro' => '',
        'logradouro' => '',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
