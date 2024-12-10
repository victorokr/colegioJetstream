<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;


class ReturnGuardSistemDefault
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        //dd(Auth::getDefaultDriver());
        if ($guard) {
            Auth::shouldUse($guard); // Cambiar al guard correcto dinámicamente
            config(['fortify.guard' => $guard]); // Actualizar el guard de Fortify
        }

        
        return $next($request);
    }
}
