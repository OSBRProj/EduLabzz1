<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ProgressoConteudo extends Model
{
    protected $table = 'progresso_conteudo';

    //Preenchiveis
    protected $fillable = [
        'conteudo_id',
        'user_id',
        'tipo',
        'progresso',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
        'tipo' => 1,
        'progresso' => 0
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
