<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

use App\EnderecoUser;

class CheckPerfilCompleto
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {      
            $user = Auth::user();

            if(EnderecoUser::find($user->id) == null || $user->telefone == '' || $user->cpf == '' || $user->rg == '' || $user->nome_completo == '')
            {
                return redirect()->route('perfil-incompleto');
            }
        }
        else
        {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
