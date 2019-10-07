<?php

namespace App\Entities\Metrica\Api;


use App\Metrica;

class Repository
{
  private $metrica;
  
  public function __construct(Metrica $metrica)
  {
    $this->metrica = $metrica;
  }
  
  public function store($values)
  {
    return $this->metrica->create($values);
  }
  
}