<?php

namespace App\Entities\Playlist;

use Illuminate\Database\Eloquent\Model;

class PlaylistAudio extends Model
{
    protected $table = "playlist_audios";

    //Preenchiveis
    protected $fillable = [
        'playlist_id',
        'audio_id'
    ];
}
