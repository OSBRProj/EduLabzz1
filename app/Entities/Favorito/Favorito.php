<?php

namespace App\Entities\Favorito;

use App\Conteudo;
use App\Entities\Album\Album;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Favorito extends Model
{

    protected $table = "favoritos";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'referencia_id',
        'tipo',
        'conteudo_id',
        'album_id',
        'audio_id',
    ];




    public function conteudo()
    {
        return $this->belongsTo(Conteudo::class, 'referencia_id');
    }




    public function albums()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }




    public function audios()
    {
        return $this->belongsTo(Album::class, 'audio_id');
    }


}
