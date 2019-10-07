<?php

namespace App\Http\Controllers\PlanoEstudos\Alunos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanoEstudosController extends Controller
{
    public function index()
    {
        return view('pages.plano-estudos.alunos.index');
    }
}
