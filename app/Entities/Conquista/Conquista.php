<?php

namespace App\Entities\Conquista;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Conquista extends Model
{
    protected $table = "conquistas";
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
