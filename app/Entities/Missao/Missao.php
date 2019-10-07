<?php

namespace App\Entities\Missao;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Missao extends Model
{
    protected $table = "missoes";
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
