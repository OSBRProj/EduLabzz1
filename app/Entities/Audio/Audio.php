<?php

namespace App\Entities\Audio;

use App\Entities\Album\Album;
use App\Entities\Playlist\Playlist;
use App\Entities\AudioInteracoes\AudioInteracoes;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $table = "audios";
    protected $hidden = ['pivot'];

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'categoria_id',
        'titulo',
        'descricao',
        'file',
        'duracao'
    ];




    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }




    public function albuns()
    {
        return $this->belongsToMany(Album::class, 'album_audios', 'audio_id');
    }




    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_audios', 'audio_id');
    }




    public function interacoes()
    {
        return $this->hasMany(AudioInteracoes::class, 'audio_id')
            ->orderBy('inicio', 'ASC');
    }




    public function getIdAttribute($value)
    {
        return "$value";
    }




    public function getUrlAttribute()
    {
        $path = env("APP_URL") . '/uploads/audios/user_id_' . $this->attributes['artist'] . '/' . $this->attributes['url'];
        return $path;
    }




    public function getDurationAttribute()
    {
        $duracao = $this->attributes['duration'];
        sscanf($duracao, "%d:%d:%d", $hours, $minutes, $seconds);
        $durationSeconds = isset($hours) ? $hours * 3600 + $minutes * 60 + $seconds : $minutes * 60 + $seconds;
        return $durationSeconds;
    }




    public function getArtistAttribute()
    {
        $user = User::where('id', $this->attributes['artist'])->select('name')->first();
        return $user->name;
    }

}
