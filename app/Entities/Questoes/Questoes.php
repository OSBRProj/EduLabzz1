<?php

namespace App\Entities\Questoes;

use App\Entities\TesteNivelamento\TesteNivelamentoQuestao;
use App\Generals\Presenter\Questoes\QuestoesPresenter;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Questoes extends Model
{
    // tipo == 1 é dissertativa
    // tipo == 2 multipla escolha

    use PresentableTrait;
    protected $presenter = QuestoesPresenter::class;

    protected $table = "questoes";

    //Preenchiveis
    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'tipo',
        'alternativas',
        'resposta_correta'
    ];


}
