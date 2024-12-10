<div class="container__login"> 
    <x-GuestLayout>
        
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 text-sm text-success">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ isset($guard) ? url($guard.'/login'): route('login') }}">
                @csrf
                
                <div class=" mb-4">
                    <!-- <x-label for="floatingInput" value="{{ __('correo') }}" /> -->
                    <x-input id="email"  type="email" name="email" :value="old('email')" placeholder="ingresa tu correo" required autofocus autocomplete="username" />
                </div>

                <div class="">
                    <!-- <x-label for="floatingInput" value="{{ __('Password') }}" /> -->
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="ingresa tu contraseña" required autocomplete="current-password" />
                </div>

                <div class=" mt-4">
                    <label for="remember_me" class="d-flex justify-content-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="mx-2">{{ __('Recordar') }}</span>
                    </label>
                </div>

                <div class="login__container-forgot mt-2 text-center">
                    @if (Route::has('password.request'))
                        <a class="" href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu contraseña?') }}
                        </a>
                    @endif

                    <x-button class="btn btn-primary btn-sm mt-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
        
    </x-GuestLayout>
</div> 