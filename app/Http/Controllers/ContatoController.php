<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ContatoController extends Controller
{    
    public function index ()
    {    
        return view('contato');
    }

    public function post ()
    {
        return redirect('/');
    }
}
