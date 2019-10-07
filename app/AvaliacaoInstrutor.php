<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class AvaliacaoInstrutor extends Model
{
    protected $table = 'avaliacoes_instrutor';
    
    //Preenchiveis
    protected $fillable = [
        'user_id',
        'instrutor_id',
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

    public function instrutor()
    {
        return $this->belongsTo('App\User', 'instrutor_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}