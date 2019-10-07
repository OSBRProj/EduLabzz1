<?php

namespace App\Entities\Badges;


use App\Badge;

class Repository
{
  private $badge;
  
  public function __construct(Badge $badge)
  {
    $this->badge = $badge;
  }
  
  // listar todas as badges
  public function all()
  {
    return $this->badge->all();
  }
  
  
  //deletar uma badge
  public function delete($id)
  {
    return $this->badge->find($id)->delete();
  }
  
  // cadastrar novas badges
  public function store($values)
  {
    $this->badge->create($values);
  }
  
  
  // atualiza uma badge
  public function update($id, $values)
  {
    return $this->badge->find($id)->update($values);
  }
  
  // Retorna uma badge
  public function find($idBadge)
  {
    return $this->badge->find($idBadge);
  }
  
}