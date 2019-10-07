<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check())
        {
            if(Auth::user()->permissao != "A")
            {
                return redirect()->route('gestao.relatorios');
            }
            // else if(Auth::user()->permissao == "P")
            // {
            //     return redirect()->route('gestao.relatorios');
            // }
            // else if(Auth::user()->permissao == "G")
            // {
            //     return redirect()->route('gestao.relatorios');
            // }
            // else if(Auth::user()->permissao == "Z")
            // {
            //     return redirect()->route('gestao.relatorios');
            // }
            // else
            // {

            // }

            return redirect('/home');
        }

        return $next($request);
    }
}
