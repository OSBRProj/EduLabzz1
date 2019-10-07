<?php

namespace App\Entities\Recente;

use App\Entities\Album\Album;
use Illuminate\Database\Eloquent\Model;

class Recente extends Model
{
    protected $table = "recentes";
    //Preenchiveis
    protected $fillable = [
        'user_id',
        'album_id',
        'created_at',
        'updated_at'
    ];




    public function albums()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

}
