<?php

namespace App\Http\Controllers\Badges\Api;

use App\Entities\BadgeUsuario\Api\Repository as BadgeUsuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BadgesController extends Controller
{
  
  private $badgeUsuario;
  
  public function __construct(BadgeUsuario $badgeUsuario)
  {
    $this->badgeUsuario = $badgeUsuario;
  }
  
  public function desbloquearUsuarioBadge($idUsuario, $idBadge)
  {
    try {
      $this->badgeUsuario->store(['user_id' => $idUsuario, 'badge_id' => $idBadge]);
      return response()->json(["success" => "Medalha desbloqueada com sucesso!"]);
    } catch (\Exception $exception) {
      return response()->json(["error" => "Erro ao desbloquear medalha", "message:" => $exception->getMessage()]);
    }
  }
  
  public function desbloquearUsuarioAuthBadge($idBadge)
  {
    if ($this->badgeUsuario->store(['user_id' => Auth::user()->id, 'badge_id' => $idBadge])) {
      return response()->json(["success" => "Medalha desbloqueada com sucesso!"]);
    }
    return response()->json(["error" => "Erro ao desbloquear medalha"]);
  }
}
