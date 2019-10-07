<?php

namespace App\Http\Controllers\Documentacao\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentacaoController extends Controller
{
  public function index()
  {
    return view('pages.documentacao.api.index');
  }
}
