<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Transacao extends Model
{
    protected $table = 'transacoes';

    // protected $primaryKey = 'id'; // or null

    // public $incrementing = false;

    //Preenchiveis
    protected $fillable = [
        'referencia_id',
        'user_id',
        'sub_total',
        'adicional',
        'desconto',
        'frete',
        'total',
        'status',
        'metodo',
    ];

    // 0 = Criado
    // 1 = Pedente
    // 2 = Aguardando pagamento
    // 3 = Pagamento autorizado
    // 4 = Pagamento liberado
    // 7 = Pagamento cancelado

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'metodo' => '',
        'sub_total' => 0,
        'adicional' => 0,
        'desconto' => 0,
        'frete' => 0,
        'total' => 0,
    ];

    public function produtos()
    {
        return $this->hasMany('App\ProdutoTransacao', 'transacao_id', 'id');
    }

    public function produtos_user()
    {
        return $this->hasMany('App\ProdutoTransacao', 'transacao_id', 'id')->with('user');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
