<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AcudientesController;
use App\Http\Controllers\AreaacudientesController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;



Route::get('/', function () {
    return view('welcome');
});
//------------------------------------------------------

//(['usuarioRedirect:acudiente','guardMiddleware:acudiente']) Ej: asi se pasan mas middlewares
Route::middleware('usuarioRedirect:acudiente')->group(function(){

    Route::get('acudiente/login', [AcudientesController::class, 'loginForm']);
    Route::post('acudiente/login', [AcudientesController::class, 'store'])->name('acudiente.login');
});
    

//acudiente------------------------------------------------------
Route::middleware([
    'auth:sanctum,acudiente',
    config('jetstream.auth_session'),
    
])->group(function () {

    Route::get('/acudiente/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    
    Route::get('/user/profile', function () {
        return view('profile.show');
    })->name('profile.show');



    Route::post('/user/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->name('password.confirm');

//buscar la regla de validacion de contraseña
//poner aqui las rutas de user/two-factor-autentication
// Route::get('user/confirm-password', [ConfirmablePasswordController::class, 'show'])
//          ->name('user-confirm-password.show');
//  Route::get('user/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
//  Route::post('user/confirm-password', [ConfirmablePasswordController::class, 'store']);
//  Route::get('user/confirm-password-status', [ConfirmedPasswordStatusController::class, 'show'])->name('password.confirmation');

});




//Docente-------------------------------------------------------
Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    
    


});

//------------------------------------------------------------




// Route::middleware(['auth:acudiente', config('jetstream.auth_session'), 'verified'])
//     ->group(function () {
//         Route::get('/acudientes/area', [AreaacudientesController::class, 'index'])->name('areaAcudientes');
//     });

