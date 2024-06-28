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


        
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->id_estadoDocente === 2) {
                //Log them out
                Auth::guard('docente')->logout();

                //Redirect them somewhere with a message
                $request->session()->invalidate();

                $request->session()->regenerateToken();
        
                return redirect('/');
            }
        }



        return $next($request);
    }
}
