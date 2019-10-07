<?php

namespace App\Entities\HabilidadeUsuario;

use App\Entities\Habilidade\Habilidade;
use App\User;
use Illuminate\Database\Eloquent\Model;

class HabilidadeUsuario extends Model
{
  protected $table = "habilidade_usuario";
  
  //Preenchiveis
  protected $fillable = [
    'habilidade_id',
    'user_id',
    'pontos'
  ];
  
  public function habilidade()
  {
    return $this->belongsTo(Habilidade::class);
  }
  
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
  
}
