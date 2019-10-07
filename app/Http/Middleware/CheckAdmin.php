<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckAdmin
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

        if( strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "Z") === false)
        {
            return redirect('/home');

            return redirect()->back();            
        }


        return $next($request);
    }
}
