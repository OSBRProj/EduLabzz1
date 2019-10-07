<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Categoria;
use App\HelperClass;
use App\Escola;

class DashboardController extends Controller
{

    public function usuarios()
    {

        if(Input::get('qt') == null)
            $amount = 10;
        else
            $amount = Input::get('qt');

        if(Input::get('pesquisa') != null)
            $pesquisa = Input::get('pesquisa');

        if(isset($pesquisa))
        {
            $usuarios = User::PermissaoNamed(
                User::where('id', 'like', '%' . $pesquisa . '%')->
                    orWhere('email', 'like', '%' . $pesquisa . '%')->
                    orWhere('name', 'like', '%' . $pesquisa . '%')->
                paginate($amount)
            );
        }
        else
        {
            $usuarios = User::PermissaoNamed(User::paginate($amount));
        }

        $escolas = Escola::orderBy('titulo')->get();

        return view('dashboard.usuarios')->with(compact('usuarios', 'escolas', 'amount'));

    }
}
