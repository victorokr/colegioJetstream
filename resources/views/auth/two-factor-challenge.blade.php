
<div class="container__login ">    
    <x-guest-layout>
        <div class="col-4 "> 
          <div class="row ">
            <div class="card mt-5">
                    <x-authentication-card-logo />
                <div class="card-body">
                    <div x-data="{ recovery: false }">
                        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="! recovery">
                            {{ __('Confirme el acceso a su cuenta ingresando el código de autenticación proporcionado por su aplicación de autenticación.') }}
                        </div>

                        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-cloak x-show="recovery">
                            {{ __('Confirme el acceso a su cuenta ingresando uno de sus códigos de recuperación de emergencia de color rojo que se le entregó al momento de activar la doble autenticación.') }}
                        </div>

                        <x-validation-errors class="mb-4" />

                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf

                            <div class="mt-4" x-show="! recovery">
                                <x-label for="code" value="{{ __('Código') }}" />
                                <x-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                            </div>

                            <div class="mt-4" x-cloak x-show="recovery">
                                <x-label for="recovery_code" value="{{ __('Código de Recuperación') }}" />
                                <x-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="button" class="btn btn-secondary btn-sm "
                                                x-show="! recovery"
                                                x-on:click="
                                                    recovery = true;
                                                    $nextTick(() => { $refs.recovery_code.focus() })
                                                ">
                                    {{ __('Utilice un código de recuperación') }}
                                </button>

                                <button type="button" class="btn btn-secondary btn-sm"
                                                x-cloak
                                                x-show="recovery"
                                                x-on:click="
                                                    recovery = false;
                                                    $nextTick(() => { $refs.code.focus() })
                                                ">
                                    {{ __('Utilice un código de autenticación') }}
                                </button>

                                <x-button class="ms-4">
                                    {{ __('Iniciar Sesión') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
          </div>
        </div>    
    </x-guest-layout>
</div>