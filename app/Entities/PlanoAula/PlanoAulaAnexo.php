<?php

namespace App\Entities\PlanoAula;

use App\Conteudo;
use App\Generals\Presenter\PlanoAula\PlanoAulaAnexoPresenter;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class PlanoAulaAnexo extends Model
{
    use PresentableTrait;
    protected $presenter = PlanoAulaAnexoPresenter::class;

    protected $table = "plano_aula_anexos";

    //Preenchiveis
    protected $fillable = [
        'tipo', // 1 atividades - 2 materiais
        'plano_aula_id',
        'conteudo_id',
    ];

    public function conteudo()
    {
        return $this->belongsTo(Conteudo::class, 'conteudo_id');
    }

}
