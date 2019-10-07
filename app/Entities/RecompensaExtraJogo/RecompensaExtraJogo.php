<?php

namespace App\Entities\RecompensaExtraJogo;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RecompensaExtraJogo extends Model
{
    protected $table = "recompensas_extra_jogo";
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
