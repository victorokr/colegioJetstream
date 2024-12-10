<?php

use Illuminate\Foundation\Application;

use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

 use App\Http\Middleware\AdminRedirectIfAuthenticated;
 use App\Http\Middleware\RedirectIfAuthenticated;

 //use App\Http\Middleware\ReturnGuardSistemDefault;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // $middleware->append(DocenteActivo::class);

        $middleware->web(append: [
            \App\Http\Middleware\DocenteActivo::class,
            
        ]);


        $middleware->alias([
            'usuarioRedirect'=> AdminRedirectIfAuthenticated::class,
            //'guardMiddleware' => ReturnGuardSistemDefault::class,
        ]);

       
            


    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
