<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

use Laravel\Fortify\Features;
use App\Models\Docente;
use App\Models\Responsable;

use Illuminate\Contracts\Auth\StatefulGuard; 
use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Http\Controller\AcudientesController;
use Illuminate\Support\Facades\Auth;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when([AcudientesController::class,
                          AttemptToAuthenticate::class,
                          RedirectIfTwoFactorAuthenticatable::class])->needs(
                          StatefulGuard::class)->give(function(){
                            return Auth::guard('acudiente');
                          });


        

// $this->app->when([AcudientesController::class, AttemptToAuthenticate::class, RedirectIfTwoFactorAuthenticatable::class])
//     ->needs(StatefulGuard::class)
//     ->give(function () {
//         return Auth::guard('acudiente');
//     });

// // El resto para "docente" o predeterminado...
// $this->app->when(AttemptToAuthenticate::class)
//     ->needs(StatefulGuard::class)
//     ->give(function () {
//         return Auth::guard('web'); // Guard predeterminado
//     });


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {

//-------------------------------------------------------------------------------------------------------------------------
        //clases que vienen por deafault en la instalacion de jetstream
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id')); 
        });


    }//end boot





      










}
