<?php

namespace App\Entities\Playlist;

use App\Entities\Audio\Audio;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = "playlists";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function audios()
    {
        return $this->belongsToMany(Audio::class, 'playlist_audios', 'playlist_id');
    }




    public function getArtistAttribute()
    {
        $user = User::where('id', $this->attributes['artist'])->select('name')->first();
        return $user->name;
    }

    public function getCreatedAtAttribute($date)
    {
        return ucfirst(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans());
    }

}
