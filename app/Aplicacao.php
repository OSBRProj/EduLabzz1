<?php

namespace App;

use App\Entities\Favorito\Favorito;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Laracasts\Presenter\PresentableTrait;

class Aplicacao extends Model
{

    protected $table = 'aplicacoes';

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'status',
        'liberada',
        'destaque',
        'data_lancamento',
        'capa',
        'categoria_id',
        'nivel_ensino',
        'ano_serie',
        'tags',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'descricao'    => '',
        'status'       => 0,
        'liberada'     => 0,
        'destaque'     => 0,
        'capa'         => '',
        'categoria_id' => 1,
        'tags'         => '[]',
    ];

    // Cast fields as Carbon date
    protected $casts = [
        'tags' => 'array',
    ];

    protected $dates = [
        'data_lancamento',
    ];

    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id');
        // return $this->hasOne('App\Categoria', 'id', 'categoria_id');
    }


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function progressos()
    {
        return $this->hasMany('App\ProgressoConteudo', 'conteudo_id')->with('user')->where('tipo', '=', 1);
    }

    public function progressos_user()
    {
        return $this->hasMany('App\ProgressoConteudo', 'conteudo_id')->with('user')->where('tipo', '=', 1);
    }

    public function favorito($idUser, $idRef)
    {
        return $this->hasOne(Favorito::class, 'referencia_id')
            ->where([['user_id', $idUser], ['referencia_id', $idRef], ['tipo', 1]])->first();
    }


}
