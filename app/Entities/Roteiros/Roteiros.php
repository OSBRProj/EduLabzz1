<?php

namespace App\Entities\Roteiros;

use App\Entities\Roteiros\RoteirosTopico;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Roteiros extends Model
{
    protected $table = "roteiros";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function topicos()
    {
        return $this->hasMany(RoteirosTopico::class, 'roteiro_id')->orderBy('id', 'asc');;
    }

}
