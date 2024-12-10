
    <div class="container-fluid container__profile mt-5">
        <div class="row g-3 ">
            <div class="col-md-4 ">
                <h5>{{ __('Autenticación de Dos Factores') }}</h5>
                <p class="text-muted">{{ __('Agrega seguridad adicional a tu cuenta utilizando la autenticación de dos factores.') }}</p>
            </div>
              
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">
                                @if ($this->enabled)
                                    @if ($showingConfirmation)
                                        {{ __('Finaliza la activación de la autenticación de dos factores.') }}
                                    @else
                                        {{ __('Has activado la autenticación de dos factores.') }}
                                    @endif
                                @else
                                    {{ __('No has activado la autenticación de dos factores.') }}
                                @endif
                            </h6>

                            <div class="mt-3">
                                <p>
                                    {{ __('Cuando la autenticación de dos factores está habilitada, se te pedirá un token seguro y aleatorio durante la autenticación. Puedes obtener este token de la aplicación Google Authenticator en tu teléfono.') }}
                                </p>
                            </div>

                            @if ($this->enabled)
                                @if ($showingQrCode)
                                    <div class="mt-4">
                                        <p class="fw-semibold">
                                            @if ($showingConfirmation)
                                                {{ __('Para finalizar la activación de la autenticación de dos factores, escanea el siguiente código QR usando la aplicación de autenticación de tu teléfono o introduce la clave de configuración y proporciona el código OTP generado.') }}
                                            @else
                                                {{ __('La autenticación de dos factores está ahora activada. Escanea el siguiente código QR usando la aplicación de autenticación de tu teléfono o introduce la clave de configuración.') }}
                                            @endif
                                        </p>
                                    </div>

                                    <div class="mt-4 p-2 bg-white d-inline-block">
                                        {!! $this->user->twoFactorQrCodeSvg() !!}
                                    </div>

                                    <div class="mt-4">
                                        <p class="fw-semibold">
                                            {{ __('Clave de Configuración') }}: {{ decrypt($this->user->two_factor_secret) }}
                                        </p>
                                    </div>

                                    @if ($showingConfirmation)
                                        <div class="mt-4">
                                            <label for="code" class="form-label">{{ __('Código') }}</label>
                                            <input id="code" type="text" name="code" class="form-control w-50" inputmode="numeric" autofocus autocomplete="one-time-code"
                                                wire:model="code" wire:keydown.enter="confirmTwoFactorAuthentication">
                                            <x-input-error for="code" class="mt-2" />
                                        </div>
                                    @endif
                                @endif

                                @if ($showingRecoveryCodes)
                                    <div class="mt-4">
                                        <p class="fw-semibold">
                                            {{ __('Guarda estos códigos de recuperación en un gestor de contraseñas seguro. Se pueden usar para recuperar el acceso a tu cuenta si pierdes tu dispositivo de autenticación de dos factores.') }}
                                        </p>
                                    </div>

                                    <div class="row row-cols-1 row-cols-md-3 g-1 mt-4 bg-light p-3 rounded">
                                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                                            <div class="col">
                                                <code>{{ $code }}</code>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif

                            <div class="mt-5">
                                @if (! $this->enabled)
                                  <x-confirms-password wire:then="enableTwoFactorAuthentication">
                                    <x-button type="button" class="btn btn-primary"  wire:loading.attr="disabled">
                                        {{ __('Activar') }}
                                    </x-button>
                                  </x-confirms-password>  
                                @else
                                    @if ($showingRecoveryCodes)
                                      <x-confirms-password wire:then="regenerateRecoveryCodes">
                                        <x-button type="button" class="btn btn-secondary " >
                                            {{ __('Regenerar Códigos de Recuperación') }}
                                        </x-button>
                                      </x-confirms-password>
                                    @elseif ($showingConfirmation)
                                      <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                                        <x-button type="button" class="btn btn-primary "  wire:loading.attr="disabled">
                                            {{ __('Confirmar') }}
                                        </x-button>
                                      </x-confirms-password>
                                    @else
                                      <x-confirms-password wire:then="showRecoveryCodes">
                                        <x-button type="button" class="btn btn-secondary " >
                                            {{ __('Mostrar Códigos de Recuperación') }}
                                        </x-button>
                                      </x-confirms-password>
                                    @endif

                                    @if ($showingConfirmation)
                                      <x-confirms-password wire:then="disableTwoFactorAuthentication">
                                        <x-button type="button" class="btn btn-secondary"  wire:loading.attr="disabled">
                                            {{ __('Cancelar') }}
                                        </x-button>
                                      </x-confirms-password> 
                                    @else
                                      <x-confirms-password wire:then="disableTwoFactorAuthentication">
                                        <x-button type="button" class="btn btn-danger"  wire:loading.attr="disabled">
                                            {{ __('Desactivar') }}
                                        </x-button>
                                      </x-confirms-password>

                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div> 
                
        </div>
    </div>
   