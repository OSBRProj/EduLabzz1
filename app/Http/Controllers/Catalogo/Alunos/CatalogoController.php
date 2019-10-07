<?php

namespace App\Http\Controllers\Catalogo\Alunos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatalogoController extends Controller
{
    public function index()
    {
        return view('pages.catalogo.alunos.index');
    }
}
