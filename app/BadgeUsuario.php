<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class BadgeUsuario extends Model
{
    protected $table = 'badge_usuario';

    //Preenchiveis
    protected $fillable = [
        'badge_id',
        'user_id',
    ];

    public function badge()
    {
        return $this->belongsTo('App\Badge', 'badge_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
