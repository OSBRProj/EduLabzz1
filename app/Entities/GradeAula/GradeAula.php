<?php

namespace App\Entities\GradeAula;

use App\Entities\PlanoAula\PlanoAula;
use App\User;
use Illuminate\Database\Eloquent\Model;

class GradeAula extends Model
{
    protected $table = "grade_aulas";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'turma_id',
        'titulo',
        'descricao',
        'data',
        'data_inicial',
        'hora_inicial',
        'data_final',
        'hora_final',
        'recorrente',
        'dia',
        'cor',
    ];

    public function professor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function planos()
    {
        return $this->hasMany(PlanoAula::class, 'grade_aula_id');
    }

}
