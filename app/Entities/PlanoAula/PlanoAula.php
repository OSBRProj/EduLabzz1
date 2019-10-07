<?php

namespace App\Entities\PlanoAula;

use App\Entities\GradeAula\GradeAula;
use Illuminate\Database\Eloquent\Model;

class PlanoAula extends Model
{
    protected $table = "plano_aulas";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'grade_aula_id',
        'assunto',
        'tarefa_classe',
        'tarefa_casa',
        'data',
        'objetivos',
        'topicos_conhecimento',
        'habilidades_competencias',
        'etapas_atividades',
        'recursos_necessarios',
        'avaliacao',
        'metodologia',
        'tema',
        'nivel_ensino',
        'ano_serie',
        'materia',
        'quantidade_aulas'
    ];

    public function grade()
    {
        return $this->belongsTo(GradeAula::class, 'grade_aula_id');
    }

    public function anexosAll()
    {
        return $this->hasMany(PlanoAulaAnexo::class, 'plano_aula_id');
    }

    public function anexosAtividades()
    {
        return $this->hasMany(PlanoAulaAnexo::class, 'plano_aula_id')->where('tipo', 1);
    }

    public function anexosMateriais()
    {
        return $this->hasMany(PlanoAulaAnexo::class, 'plano_aula_id')->where('tipo', 2);
    }

}
