<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class AvaliacaoArtigoAjuda extends Model
{
    protected $table = 'avaliacao_artigo_ajuda';

    //Preenchiveis
    protected $fillable = [
        'id',
        'artigo_ajuda_id',
        'user_id',
        'avaliacao',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
    ];

    public function artigo()
    {
        return $this->belongsTo('App\ArtigoAjuda', 'artigo_ajuda_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
