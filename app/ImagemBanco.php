<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

use Carbon\Carbon;


class ImagemBanco extends Model
{
    protected $table = 'imagem_banco';

    //Preenchiveis
    protected $fillable = [
        'id',
        'user_id',
        'escola_id',
        'titulo',
        'descricao',
        'original_name',
        'file_name',
        'visibilidade',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'escola_id' => 1,
        'visibilidade' => 0,
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
