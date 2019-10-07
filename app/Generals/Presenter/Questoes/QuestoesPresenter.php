<?php


namespace App\Generals\Presenter\Questoes;


use Laracasts\Presenter\Presenter;

class QuestoesPresenter extends Presenter
{
    public function questoesTipo()
    {
        if ($this->tipo === 1) {
            return 'Dissertativa';
        }

        if($this->tipo === 2){
            return 'Múltipla escolha';
        }

        return 'Nenhum tipo encontrado';
    }
}
