<?php

namespace App\Entities\AudioInteracoes;

use App\Entities\Audio\Audio;
use App\User;
use Illuminate\Database\Eloquent\Model;

class AudioInteracoes extends Model
{
    protected $table = "audios_interacoes";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'audio_id',
        'titulo',
        'descricao',
        'inicio',
        'fim'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function interacao()
    {
        return $this->belongsTo(Audio::class, 'audio_id');
    }

}
