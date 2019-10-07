<?php

namespace App\Entities\Users;


use App\User;

class Repository
{
  private $user;
  
  public function __construct(User $user)
  {
    $this->user = $user;
  }
  
  
  // listar todos os usuários
  public function getAll($wherePermission = null)
  {
    if ($wherePermission !== null) {
      return $this->user->where('permissao', $wherePermission)->get();
    }
    return $this->user->all();
    
  }
  
}