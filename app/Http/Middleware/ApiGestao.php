<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApiGestao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "P") === false && strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "G") === false && strrpos(mb_strtoupper(Auth::user()->permissao, 'UTF-8'), "Z") === false) {
            return response()->json(["error" => "Você não tem permissão para realizar esta ação"]);
        }
        
        return $next($request);
    }
}
