<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ArtigoAjuda extends Model
{
    protected $table = 'artigo_ajuda';

    //Preenchiveis
    protected $fillable = [
        'id',
        'user_id',
        'titulo',
        'conteudo',
        'categoria',
        'marcadores',
        'status',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'categoria' => '',
        'marcadores' => '',
        'status' => 0,
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function avaliacoes()
    {
        return $this->belongsTo('App\AvaliacaoArtigoAjuda');
    }

    public function avaliacoes_user()
    {
        return $this->belongsTo('App\AvaliacaoArtigoAjuda', 'id', 'artigo_ajuda_id')->where(function($query) {

            if(\Auth::check())
            {
                $query->where('user_id', '=', \Auth::user()->id);
            }
            else
            {
                $query->whereNull('id');
            }

        });
    }

}
