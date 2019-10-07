<?php

namespace App\Entities\Album;

use App\Entities\Audio\Audio;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = "albums";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo',
        'capa',
        'descricao',
        'categoria'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'categoria');
    }


    public function audios()
    {
        return $this->belongsToMany(Audio::class, 'album_audios', 'album_id');
    }

    public function getUrlAttribute()
    {
        $path = env("APP_URL") . '/uploads/albuns/capas/app/' . $this->attributes['url'];
        return $path;
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
