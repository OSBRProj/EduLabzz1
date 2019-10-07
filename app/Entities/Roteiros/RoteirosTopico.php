<?php

namespace App\Entities\Roteiros;

use App\Roteiro;
use Illuminate\Database\Eloquent\Model;

class RoteirosTopico extends Model
{

    protected $table = "roteiros_topicos";

    //Preenchiveis
    protected $fillable = [
        'titulo',
        'roteiro_id',
        'status',
    ];

    public $topicosAtivos;
    public $topicosInativos;

    //atributos
    protected $attributes = [
    ];


    public function topico()
    {
        return $this->belongsTo(Roteiros::class, 'roteiro_id');
    }
    
}
