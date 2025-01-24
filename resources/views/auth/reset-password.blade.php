<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}" class="validation-form">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Correo') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <img class="img-password cursor-pointer" data-input="contraseña-nueva" role="button" width="" height="" src="{{ asset('images/ojo.png') }}" alt="" />
                <x-input id="contraseña-nueva" class="block mt-1 w-full input-password" type="password"  name="password" required autocomplete="new-password"
                required data-parsley-pattern="^(?=(.*[A-Z]))(?=(.*\d))(?=(.*[^\w\s])).{10,}$" data-parsley-trigger="keyup"/>
                <span id="passwordHelpInline" class="form-text">10 caracteres, 1 especial, 1 mayuscula y 1 numero.</span>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <img class="img-password cursor-pointer" data-input="confirmar-contraseña" role="button" width="" height="" src="{{ asset('images/ojo.png') }}" alt="" />
                <x-input id="confirmar-contraseña" class="block mt-1 w-full input-password" type="password" name="password_confirmation" required autocomplete="new-password"
                data-parsley-equalto="#contraseña-nueva" data-parsley-trigger="keyup" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Restablecer contraseña') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
