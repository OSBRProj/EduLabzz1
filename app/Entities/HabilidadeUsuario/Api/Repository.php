<?php

namespace App\Entities\HabilidadeUsuario\Api;

use App\Entities\HabilidadeUsuario\HabilidadeUsuario;

class Repository
{
  private $habilidadeUsuario;
  
  public function __construct(HabilidadeUsuario $habilidadeUsuario)
  {
    $this->habilidadeUsuario = $habilidadeUsuario;
  }
  
  public function store($values)
  {
    return $this->habilidadeUsuario->create($values);
  }
  
}