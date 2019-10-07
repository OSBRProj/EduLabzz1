<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoteiroTopico extends Model
{
    protected $table = 'roteiros_topicos';

    //Preenchiveis
    protected $fillable = [
        'roteiro_id',
        'user_id',
        'status'
    ];

    public $topicosAtivos;
    public $topicosInativos;

    // Protegidos
    protected $hidden = [
    ];

    //Atributos
    protected $attributes = [
    ];

    public function topico()
    {
        return $this->belongsTo('App\Roteiro');
    } 
    
    public function topicosAtivos()
    {
        return $query::where('status', 1);
    }

    public function topicosInativos()
    {
        return $query::where('status', 0);
    }

}
