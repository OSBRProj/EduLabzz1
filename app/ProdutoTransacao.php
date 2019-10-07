<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ProdutoTransacao extends Model
{
    protected $table = 'produto_transacao';

    //Preenchiveis
    protected $fillable = [
        'transacao_id',
        'user_id',
        'produto_id',
        'titulo',
        'descricao',
        'tipo',
        'valor',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao' => '',
        'tipo' => '1',
    ];

    // Tipos
    // 1 = Licenças
    // 2 = Cursos

    // public function transacao()
    // {
    //     return $this->belongsTo('App\Transacao');
    // }

    public function transacao()
    {
        return $this->belongsTo('App\Transacao', 'transacao_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
