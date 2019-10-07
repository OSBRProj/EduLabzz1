<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Badge extends Model
{
  //Preenchiveis
  protected $fillable = [
    'user_id',
    'titulo',
    'descricao',
    'visibilidade',
    'icone'
  ];
  
  // Protegidos
  protected $hidden = [
  ];
  
  //Padrões
  protected $attributes = [
    'descricao'    => '',
    'visibilidade' => 1,
  ];
  
  public function user()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
  
  public function minhas()
  {
    return $this;
  }
  
}
