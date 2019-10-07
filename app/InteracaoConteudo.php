<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class InteracaoConteudo extends Model
{
    protected $table = 'interacao_conteudo';

    //Preenchiveis
    protected $fillable = [
        'conteudo_id',
        'user_id',
        'tipo',
        'inicio',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'tipo' => 1,
        'inicio' => '0000-00-00 00:00:00'
    ];

    // Tipos de conteudo
    // 1 = Aplicação ( Jogos )
    // 2 = Conteudo ( Vídeos, documentos, slides etc)

    public function aplicacao()
    {
        return $this->belongsTo('App\Aplicacao', 'conteudo_id');
    }

    public function conteudo()
    {
        return $this->belongsTo('App\Conteudo', 'conteudo_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
