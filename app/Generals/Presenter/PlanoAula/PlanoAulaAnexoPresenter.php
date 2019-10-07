<?php

namespace App\Generals\Presenter\PlanoAula;


use Laracasts\Presenter\Presenter;

class PlanoAulaAnexoPresenter extends Presenter
{
    public function planoAnexoTipo()
    {
        if ($this->tipo === 1) {
            return 'Atividades';
        }

        if ($this->tipo === 2) {
            return 'Materiais';
        }

        return 'Nenhum tipo encontrado';

        // 1 atividades - 2 materiais
    }
}
