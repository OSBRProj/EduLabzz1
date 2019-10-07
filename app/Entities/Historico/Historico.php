<?php

namespace App\Entities\Historico;

use App\Conteudo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $table = "historicos";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'referencia_id',
        'tipo',
    ];


    public function conteudo()
    {
        return $this->belongsTo(Conteudo::class, 'referencia_id');
    }


}
