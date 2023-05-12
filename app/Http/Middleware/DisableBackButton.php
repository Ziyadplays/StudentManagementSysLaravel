<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class disableBackButton
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response =  $next($request);
        $response->headers->set('Cache-Control' , 'nocache,no-store,max-age=0,must-revalidate');
        $response->headers->set('Pragma','nocache');
        $response->headers->set("Expires", "    Thu, 19 Nov 1981 08:52:00 GMT");
        return $response;
    }
}
