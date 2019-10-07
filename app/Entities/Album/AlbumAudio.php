<?php

namespace App\Entities\Album;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AlbumAudio extends Model
{
    protected $table = "album_audios";

    //Preenchiveis
    protected $fillable = [
        'album_id',
        'audio_id'
    ];

}
