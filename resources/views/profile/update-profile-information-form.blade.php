
   
   <div class="container-fluid container__profile">
        <div class="row g-3 ">
            <div class="col-md-4 ">
                <h3>{{ __('Información del perfil') }}</h3>
                <p class="text-muted">{{ __('Actualiza tu información de perfil y correo electrónico.') }}</p>
            </div>

            <div class="col-md-8">
                <form wire:submit.prevent="updateProfileInformation" class="validation-form">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Profile Photo -->
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <div x-data="{photoName: null, photoPreview: null}" class="col-12">
                                        <!-- Profile Photo File Input -->
                                        <input type="file" id="photo" class="d-none"
                                            wire:model.live="photo"
                                            x-ref="photo"
                                            x-on:change="
                                                photoName = $refs.photo.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    photoPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.photo.files[0]);
                                            " />

                                        <label for="photo" class="form-label">{{ __('Photo') }}</label>

                                        <!-- Current Profile Photo -->
                                        <div class="mt-2" x-show="!photoPreview">
                                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-circle" style="width: 80px; height: 80px;">
                                        </div>

                                        <!-- New Profile Photo Preview -->
                                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                                            <span class="d-block rounded-circle" style="width: 80px; height: 80px; background-size: cover; background-position: center;"
                                                x-bind:style="'background-image: url(' + photoPreview + ');'"></span>
                                        </div>

                                        <button class="btn btn-secondary mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                                            {{ __('Seleccionar una nueva foto') }}
                                        </button>

                                        @if ($this->user->profile_photo_path)
                                            <button type="button" class="btn btn-danger mt-2" wire:click="deleteProfilePhoto">
                                                {{ __('Eliminar foto') }}
                                            </button>
                                        @endif

                                        <x-input-error for="photo" class="mt-2" />
                                    </div>
                                @endif

                                <!-- Name -->
                                <div class="col-12">
                                    <label for="nombres" class="form-label">{{ __('Nombres') }}</label>
                                    <input id="nombres" type="text" class="form-control" wire:model="state.nombres" required autocomplete="nombres" required data-parsley-pattern="^([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+[\s])+([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])+[\s]?([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])?$" data-parsley-length="[3, 40]" data-parsley-trigger="keyup">
                                    <x-input-error for="nombres" class="mt-2" /> 
                                </div>

                                <!-- Email -->
                                <div class="col-12">
                                    <label for="email" class="form-label">{{ __('Correo electronico') }}</label>
                                    <input id="email" type="email" class="form-control" wire:model="state.email" required autocomplete="username">
                                    <x-input-error for="email" class="mt-2" />
                                    
                                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                                        <p class="text-muted mt-3">
                                            {{ __('Tu dirección de correo no está verificada.') }}
                                            <button type="button" class="btn btn-link p-0" wire:click.prevent="sendEmailVerification">
                                                {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                                            </button>
                                        </p>

                                        @if ($this->verificationLinkSent)
                                            <p class="mt-2 text-success">
                                                {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo.') }}
                                            </p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            <div wire:loading wire:target="photo" class="spinner-border me-3" role="status"></div>
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
     