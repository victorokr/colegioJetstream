<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Illuminate\Routing\Pipeline;

use Illuminate\Routing\Controller;
use App\Http\Response\LoginResponse;
use Illuminate\Support\Facades\Auth;


use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Actions\Fortify\AttemptToAuthenticate;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Contracts\LoginViewResponse;

use Laravel\Fortify\Actions\CanonicalizeUsername;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;

class AcudientesController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        // dd([
        //     'Default Guard' => Auth::getDefaultDriver(), // Verifica el guard activo
        //     'Active Guard' => config('fortify.guard'),   // Guard configurado en Fortify
        //     'User' => Auth::guard()->user(),            // Usuario autenticado (si existe)
        //     'Request Data' => $request->all()           // Datos del request
        // ]);

        // dd([
        //     'Guard Class' => get_class(Auth::guard(config('fortify.guard'))),
        //     'User Instance' => Auth::guard(config('fortify.guard'))->user(),
        // ]);

        // $user = \App\Models\Responsable::where('email', $request->email)->first();
        // dd(['Acudiente encontrado' => $user]);

//         $guard = Auth::getDefaultDriver(); // Asegura que se usa el guard correcto
// if (Auth::guard($guard)->attempt($credentials)) {
//     return redirect()->intended(route('dashboard'));
// }
        
        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            config('fortify.lowercase_usernames') ? CanonicalizeUsername::class : null,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));

        // dd([
        //     'Pipeline Guards' => Auth::getDefaultDriver(),
        //     'Pipeline User' => Auth::guard()->user()
        // ]);

        // return (new Pipeline(app()))->send($request)->through(array_filter([
        //     config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
        //     config('fortify.lowercase_usernames') ? CanonicalizeUsername::class : null,
        //     Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
        //     // function ($request, $next) {
        //     //     dd([
        //     //         'Default Guard' => Auth::getDefaultDriver(),
        //     //         'User' => Auth::guard()->user(),
        //     //         'viaRemember' => is_callable([Auth::guard(), 'viaRemember']) 
        //     //             ? Auth::guard()->viaRemember() 
        //     //             : 'Method not available'
        //     // ]);
        //     //     return $next($request);
        //     // },
        //     AttemptToAuthenticate::class,
        //     PrepareAuthenticatedSession::class,
        // ]));



    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return app(LogoutResponse::class);
    }


    public function loginForm(){
        return view('auth.login',['guard' => 'acudiente']);
    }

    



}
