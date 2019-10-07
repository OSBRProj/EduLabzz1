<?php

namespace App\Entities\Glossario;


class Repository
{
  private $glossario;
  
  public function __construct(Glossario $glossario)
  {
    $this->glossario = $glossario;
  }
  
  public function all($word)
  {
    return $this->glossario
      ->where('key', $word)
      ->orderBy('word', 'ASC')
      ->get();
  }
  
  public function search($word)
  {
    return $this->glossario
      ->where('word', 'like', '%' . $word . '%')
      ->orWhere('description', 'like', '%' . $word . '%')
      ->orderBy('word', 'ASC')
      ->get();
  }
  
  public function store($values)
  {
    return $this->glossario->create($values);
  }
}