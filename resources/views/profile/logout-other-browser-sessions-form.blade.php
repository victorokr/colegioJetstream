<div class="container-fluid container__profile mt-5">
    <div class="row g-3 ">
      <div class="col-md-4 ">
         <h5>{{ __('Sesiones del Navegador') }}</h5>
         <p class="text-muted">{{ __('Gestiona y cierra sesión en tus sesiones activas en otros navegadores y dispositivos.') }}</p>
      </div>  
      <div class="col-md-8">  
        <div class="card mb-5">
            <div class="card-body">
                <p class="text-muted">
                    {{ __('Si es necesario, puedes cerrar sesión en todas tus otras sesiones de navegador en todos tus dispositivos. Algunas de tus sesiones recientes se enumeran a continuación; sin embargo, esta lista puede no ser exhaustiva. Si sientes que tu cuenta ha sido comprometida, también deberías actualizar tu contraseña.') }}
                </p>

                @if (count($this->sessions) > 0)
                    <div class="mt-4 d-flex flex-row">
                        <!-- Otras sesiones del navegador -->
                        @foreach ($this->sessions as $session)
                            <div class="d-flex  align-items-center mb-3">
                                <div>
                                    @if ($session->agent->isDesktop())
                                        <!-- Icono para escritorio -->
                                        <div>
                                            <img class="img-fluid" width="40" height="40" src="{{ asset('images/computadora.png') }}" alt="" />
                                        </div>
                                    @else
                                        <!-- Icono para móvil -->
                                        <div>
                                            <img class="img-fluid" width="40" height="40" src="{{ asset('images/telefono-movil.png') }}" alt="" />
                                        </div>
                                    @endif
                                </div>

                                <div class="ms-3">
                                    <div class="text-muted">
                                        {{ $session->agent->platform() ? $session->agent->platform() : __('Desconocido') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Desconocido') }}
                                    </div>

                                    <div class="text-muted">
                                        <small>
                                            {{ $session->ip_address }},

                                            @if ($session->is_current_device)
                                                <span class="text-success fw-semibold">{{ __('Este dispositivo') }}</span>
                                            @else
                                                {{ __('Última actividad') }} {{ $session->last_active }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="d-flex align-items-center mt-4">
                    <x-button type="button" class="btn btn-primary" wire:click="confirmLogout" wire:loading.attr="disabled">
                        {{ __('Cerrar otras sesiones') }}
                    </x-button>

                    <span class="ms-3 text-success" wire:loading.remove wire:target="confirmLogout">
                        {{ __('Hecho.') }}
                    </span>
                </div>
            </div>
        </div>

       
        <!-- Log Out Other Devices Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingLogout">
            <x-slot name="title">
                {{ __('Cerrar otras sesiones del navegador') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Por favor, introduce tu contraseña para confirmar que deseas cerrar tus otras sesiones de navegador en todos tus dispositivos.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-button class="ms-3"
                            wire:click="logoutOtherBrowserSessions"
                            wire:loading.attr="disabled">
                    {{ __('Cerrar otras sesiones del navegador') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
      </div>  
    </div>    
</div>
