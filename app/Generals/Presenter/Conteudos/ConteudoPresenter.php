<?php


namespace App\Generals\Presenter\Conteudos;


use Laracasts\Presenter\Presenter;

class ConteudoPresenter extends Presenter
{

    public function conteudoTipo()
    {
        if ($this->tipo === 1) {
            return 'Misto';
        }

        if ($this->tipo === 2) {
            return 'Áudio';
        }

        if ($this->tipo === 3) {
            return 'Vídeo';
        }

        if ($this->tipo === 4) {
            return 'Slide';
        }

        if ($this->tipo === 5) {
            return 'Transmissão';
        }

        if ($this->tipo === 6) {
            return 'Upload';
        }

        if ($this->tipo === 7) {
            return 'Dissertativa';
        }

        if ($this->tipo === 8) {
            return 'Quiz';
        }

        if ($this->tipo === 9) {
            return 'Prova';
        }

        if ($this->tipo === 10) {
            return 'Entregável';
        }

        if ($this->tipo === 11) {
            return 'Livro digital';
        }

        return 'nenhum tipo encontrado';
    }
}
