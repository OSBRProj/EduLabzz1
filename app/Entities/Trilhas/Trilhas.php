<?php

namespace App\Entities\Trilhas;

use App\Curso;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Trilhas extends Model
{
    protected $table = "trilhas";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo',
        'capa',
        'descricao'
    ];




    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }




    /*public function cursos()
    {
        return $this->hasMany(TrilhasCurso::class, 'trilha_id');
    }*/

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'trilhas_cursos', 'trilha_id');
    }


}
