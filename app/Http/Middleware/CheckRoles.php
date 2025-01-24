<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;


class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Usamos el operador de desempaquetado (...$roles) en lugar de func_get_args().
        // Aseguramos compatibilidad con auth()->check() para evitar errores si el usuario no está autenticado.
        //dd(auth()->user(), method_exists(auth()->user(), 'hasRoles'));
        if (auth()->check() && auth()->user()->hasRoles($roles)) {
            return $next($request);
        }
    
        return redirect()->route('dashboard'); // Redirige si no tiene el role
        
    }
}
