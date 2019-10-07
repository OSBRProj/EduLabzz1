<?php

namespace App\Entities\BadgeUsuario\Api;


use App\BadgeUsuario;

class Repository
{
  private $badgeUsuario;
  
  public function __construct(BadgeUsuario $badgeUsuario)
  {
    $this->badgeUsuario = $badgeUsuario;
  }
  
  public function store($values)
  {
    return $this->badgeUsuario->create($values);
  }
  
}