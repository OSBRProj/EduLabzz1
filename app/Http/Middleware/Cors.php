<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        $response = $next($request);
        // $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Content-Range, Content-Disposition, Content-Description, X-Auth-Token');
        // $response->header('Access-Control-Allow-Origin', '*');
        // $response->header('Access-Control-Allow-Origin', '*');
        // $response->header('Access-Control-Allow-Credentials', 'true');
        // $response->header('Access-Control-Allow-Origin', 'http://localhost:8100');
        // $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        //add more headers here
        return $response;

        // return $next($request);

    }
}
