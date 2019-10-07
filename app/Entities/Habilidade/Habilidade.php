<?php

namespace App\Entities\Habilidade;

use App\Entities\HabilidadeUsuario\HabilidadeUsuario;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Habilidade extends Model
{
  
  protected $table = 'habilidades';
  
  //Preenchiveis
  protected $fillable = [
    'user_id',
    'titulo',
    'visibilidade',
    'categoria'
  ];
  
  // Protegidos
  protected $hidden = [
  ];
  
  //Padrões
  protected $attributes = [
    'visibilidade' => 1,
  ];
  
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
  
  public function habilidade_usuario()
  {
    return $this->belongsTo(Habilidade::class);
  }
  
  public function minhas()
  {
    return $this;
  }
}
