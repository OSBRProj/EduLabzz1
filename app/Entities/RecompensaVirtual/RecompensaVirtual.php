<?php

namespace App\Entities\RecompensaVirtual;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RecompensaVirtual extends Model
{
    protected $table = "recompensas_virtuais";
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
