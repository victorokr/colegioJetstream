<div class="container__login ">    
    <x-guest-layout>
        <div class="col-4 "> 
            <div class="row ">
                <div class="card mt-5">  
                        <x-authentication-card-logo />
                    <div class="card-body">

                        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('¿Olvidaste tu contraseña? Ningún problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña que le permitirá elegir una nueva.') }}
                        </div>

                        @session('status')
                            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ $value }}
                            </div>
                        @endsession

                        <x-validation-errors class="mb-4" />

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="block">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button>
                                    {{ __('Enviar enlace') }}
                                </x-button>
                            </div>
                        </form>
                    </div>    
                </div>  
            </div>    
        </div>
    </x-guest-layout>
</div>