<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class DocenteActivo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if any user is authenticated
        if (Auth::check()) {
            // Detect the current guard (docente or acudiente)
            $guard = Auth::getDefaultDriver();

            $user = Auth::user(); // Get the current authenticated user

            // Check if the user is not active (id_estadoUsuario == 2)
            if ($user->id_estadoUsuario === 2) {
                 // El condicional method_exists(Auth::guard($guard), 'logout') es útil en caso de que uses múltiples guards y algunos no admitan sesiones, como:
                 //Guards basados en tokens (API Token).
                 //Guards personalizados que no implementan logout.
                if (method_exists(Auth::guard($guard), 'logout')) {
                    // Log out the user
                    Auth::guard($guard)->logout();
                }

                // Invalidate the session
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Redirect to the login page with a message
                return redirect('/')->with('error', 'Tu cuenta ha sido desactivada.');
            }
        }



        return $next($request);
    }
}
