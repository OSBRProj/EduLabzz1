<?php

namespace App\Entities\HabilidadeUsuario;


use App\Entities\HabilidadeUsuario\HabilidadeUsuario;
use Illuminate\Support\Facades\Auth;

class Repository
{
    private $habilidadeusuario;

    public function __construct(HabilidadeUsuario $habilidadeUsuario)
    {
        $this->habilidadeusuario = $habilidadeUsuario;
    }

    public function all()
    {
        return $this->habilidadeusuario->with('habilidade')->where('user_id', Auth::user()->id)->get();
    }

}
