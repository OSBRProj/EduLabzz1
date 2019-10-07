<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\Conteudo;

use App\Entities\Anotacao\Anotacao;

class ApostilaController extends Controller
{
    public function index($conteudo_id)
    {
        $conteudo = Conteudo::find($conteudo_id);

        if($conteudo == null)
        {
            return redirect("404");
            // return redirect()->back()->withErrors("Conteúdo não encontrado!");
        }

        $anotacoes = Anotacao::where([['conteudo_id', '=', $conteudo_id], ['user_id', '=', Auth::user()->id]])->get();

        $marcadores = [];

        return view('play.leitor-apostila')->with( compact('conteudo', 'anotacoes', 'marcadores') );
    }

}
