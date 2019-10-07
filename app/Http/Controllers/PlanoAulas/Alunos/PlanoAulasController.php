<?php

namespace App\Http\Controllers\PlanoAulas\Alunos;

use App\Entities\PlanoAula\PlanoAula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanoAulasController extends Controller
{

    public function index($idPlano)
    {
        $plano = PlanoAula::find($idPlano);
        return view('pages.plano-aulas.alunos.index', compact('plano'));
    }

}
