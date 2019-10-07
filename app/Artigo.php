<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

use Carbon\Carbon;


class Artigo extends Model
{
    //Preenchiveis
    protected $fillable = [
        'id',
        'user_id',
        'escola_id',
        'titulo',
        'subtitulo',
        'descricao',
        'conteudo',
        'capa',
        'status',
        'categoria_id',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'escola_id' => 1,
        'status' => 0,
        'categoria_id' => 1,
    ];

    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
