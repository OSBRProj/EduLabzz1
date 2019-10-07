<?php

namespace App;

use App\Entities\Favorito\Favorito;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

use Carbon\Carbon;


class ConteudoAula extends Model
{
    protected $table = 'conteudo_aula';

    //Preenchiveis
    protected $fillable = [
        'id',
        'ordem',
        'curso_id',
        'aula_id',
        'conteudo_id',
        'user_id',
        'obrigatorio',
    ];

    // Protegidos
    protected $hidden = [
    ];

    //Padrões
    protected $attributes = [
    ];

    public function conteudo()
    {
        return $this->belongsTo('App\Conteudo', 'conteudo_id');//->where([['curso_id', '=', $this->curso_id], ['aula_id', '=', $this->aula_id]]);
    }

    public function progressos()
    {
        return $this->hasMany('App\ProgressoConteudo', 'conteudo_id')->where('tipo', '=', 2);
    }

    public function progressos_user()
    {
        return $this->hasMany('App\ProgressoConteudo', 'conteudo_id')->with('user')->where('tipo', '=', 2);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function favorito($idUser, $idRef)
    {
        return $this->hasOne(Favorito::class, 'referencia_id')
            ->where([['user_id', $idUser], ['referencia_id', $idRef], ['tipo', 2]])->first();
    }

}
