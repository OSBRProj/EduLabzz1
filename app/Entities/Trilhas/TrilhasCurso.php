<?php

namespace App\Entities\Trilhas;

use App\Curso;
use Illuminate\Database\Eloquent\Model;

class TrilhasCurso extends Model
{
    protected $table = "trilhas_cursos";

    //Preenchiveis
    protected $fillable = [
        'trilha_id',
        'curso_id'
    ];




    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }




    public function trilha()
    {
        return $this->belongsTo(Trilhas::class, 'trilha_id');
    }
}
