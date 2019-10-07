<?php

namespace App\Http\Controllers\Habilidades\Api;

use App\Entities\HabilidadeUsuario\Api\Repository as HabilidadeUsuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HabilidadesController extends Controller
{
  private $habilidadeUsuario;
  
  public function __construct(HabilidadeUsuario $habilidadeUsuario)
  {
    $this->habilidadeUsuario = $habilidadeUsuario;
  }
  
  public function UsuarioHabilidade($idUsuario, $idHabilidade, Request $request)
  {
    try {
      $this->habilidadeUsuario->store(['user_id' => $idUsuario, 'habilidade_id' => $idHabilidade, 'pontos' => $request->get('pontos')]);
      return response()->json(["success" => "Habilidade adicionada com sucesso!"]);
    } catch (\Exception $exception) {
      return response()->json(["error" => "Erro ao adicionar habilidade", "message:" => $exception->getMessage()]);
    }
  }
  
  public function UsuarioAuthHabilidade($idHabilidade, Request $request)
  {
    try {
      $this->habilidadeUsuario->store(['user_id' => Auth::user()->id, 'habilidade_id' => $idHabilidade, 'pontos' => $request->get('pontos')]);
      return response()->json(["success" => "Habilidade adicionada com sucesso!"]);
    } catch (\Exception $exception) {
      return response()->json(["error" => "Erro ao adicionar habilidade", "message:" => $exception->getMessage()]);
    }
  }
  
}
