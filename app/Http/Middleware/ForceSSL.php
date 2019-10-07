<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class ForceSSL
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
        $request=app('request');

        $host=$request->header('host');

        if (substr($host, 0, 4) != 'www.' && env("APP_ENV") == "production")
        {
            $request->headers->set('host', 'www.'.$host);
        }

        if (!$request->secure() && env("APP_ENV") == "production")
        {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
