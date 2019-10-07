<?php

namespace App\Http\Controllers\Metricas\Api;

use App\Entities\Metrica\Api\Repository as Metrica;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MetricasController extends Controller
{
  
  private $metrica;
  
  public function __construct(Metrica $metrica)
  {
    $this->metrica = $metrica;
  }
  
  public function nova(Request $request)
  {
    if ($request->get('titulo') == null) {
      return response()->json(["error" => "O campo Título é obrigatório"]);
    }
    if ($this->metrica->store([
      'titulo'    => $request->get('titulo'),
      'descricao' => $request->get('descricao'),
      'user_id'   => Auth::user()->id
    ])) {
      return response()->json(["success" => "Métrica cadastrada com sucesso!"]);
    }
    return response()->json(["error" => "Erro cadastar uma nova métrica"]);
  }
  
}
