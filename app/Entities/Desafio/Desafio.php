<?php

namespace App\Entities\Desafio;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Desafio extends Model
{
    protected $table = "desafios";
    protected $hidden = ['pivot'];

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getIdAttribute($value)
    {
        return "$value";
    }

}
