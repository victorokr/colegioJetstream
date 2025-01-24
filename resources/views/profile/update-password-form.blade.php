<div class="container-fluid container__profile mt-5">
 <div class="row g-3">
    <div class="col-md-4">
        <h3>{{ __('Actualizar contraseña') }}</h3>
        <p class="text-muted">{{ __('Asegúrese de que su cuenta utilice una contraseña fuerte para mantenerla segura.') }}</p>
        <p class="text-muted">{{ __('Ej: @Tobi eL gato13*.') }}</p>
    </div>

    <div class="col-md-8">
        <form wire:submit.prevent="updatePassword" class="validation-form">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Current Password -->
                        <div class="col-12">
                            <label for="current_password" class="form-label">{{ __('Contraseña actual') }}</label>
                            <img class="img-password cursor-pointer" data-input="contraseña-actual" title="ver contraseña" role="button" width="" height="" src="{{ asset('images/ojo.png') }}" alt="" />
                            <input class="form-control input-password" id="contraseña-actual" type="password"  wire:model="state.current_password" autocomplete="current-password">
                            <x-input-error for="current_password" class="mt-2" />
                        </div>

                        <!-- New Password -->
                        <div class="col-12 pt-3">
                            <label for="password" class="form-label">{{ __('Nueva contraseña') }}</label>
                            <img class="img-password cursor-pointer" data-input="contraseña-nueva" role="button" width="" height="" src="{{ asset('images/ojo.png') }}" alt="" />
                            <input class="form-control input-password" id="contraseña-nueva" type="password" placeholder="10 caracteres, 1 especial, 1 mayuscula y 1 numero"  wire:model="state.password" autocomplete="new-password" required autocomplete="nombres"
                            required data-parsley-pattern="^(?=(.*[A-Z]))(?=(.*\d))(?=(.*[^\w\s])).{10,}$" data-parsley-trigger="keyup" >
                            <x-input-error for="password" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-12 pt-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirmar contraseña') }}</label>
                            <img class="img-password cursor-pointer" data-input="confirmar-contraseña" role="button" width="" height="" src="{{ asset('images/ojo.png') }}" alt="" />
                            <input class="form-control input-password" id="confirmar-contraseña" type="password" wire:model="state.password_confirmation" autocomplete="new-password" data-parsley-equalto="#contraseña-nueva" data-parsley-trigger="keyup">
                            <x-input-error for="password_confirmation" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <div wire:loading class="spinner-border me-3" role="status"></div>
                    <x-action-message class="me-3" on="saved">
                        {{ __('Guardado.') }}
                    </x-action-message>
                    <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                </div>
            </div>
        </form>
    </div>
 </div>
</div>
