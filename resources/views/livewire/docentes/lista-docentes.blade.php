<div class="container-fluid">
    <div class="row">
        <div class="col d-flex justify-content-end">
            <x-button class="" wire:click="openCreateModal">Nuevo Docente</x-button>
        </div>
    </div>
    <div class="row">
        <div class="col table-responsive">
            <x-table class="">
                <caption>Lista de Docentes</caption>
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nombres</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Residencia</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Role</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Modificado(a)</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach($docentes as $docente)
                        <tr>
                            <td class="text-nowrap fw-light ">{{ $docente->nombres }}</td>
                            <td class="fw-light">{{ $docente->documento }}</td>
                            <td class="fw-light">{{ $docente->telefono }}</td>
                            <td class="text-nowrap fw-light">{{ $docente->direccion }}</td>
                            <td class="fw-light">{{ $docente->lugarDeResidencia }}</td>
                            <td class="fw-light">{{ $docente->email }}</td>
                            <td class="fw-light">{{ $docente->perfil->perfil }}</td>
                            <td class="text-nowrap fw-light">{{ $docente->roles->pluck('display_name')->implode(' - ') }}</td>
                            <td class="fw-light">{{ $docente->estadousuario->estadoUsuario }}</td>
                            <td class="fw-light">{{ $docente->updated_at->format('Y/m/d') }}</td>
                            <td class="text-nowrap">
                                <x-btn_edit class="" wire:click="openEditModal( {{$docente->id_docente}} )"></x-btn_edit>
                                <x-btn_delete
                                    class="{{ $this->canDelete($docente) ? '' : 'disabled' }}  border-0 " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"
                                    wire:click="{{ $this->canDelete($docente) ? 'openDeleteModal(' . $docente->id_docente . ')' : '' }}"
                                    title="{{ $this->canDelete($docente) ? 'Eliminar' : 'No puede eliminarse aún' }}">
                                </x-btn_delete>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-table>
        </div>
    </div>

    <!-- Modal create docente -->
    <div wire:ignore.self class="modal fade modal-dialog-scrollable" id="createDocenteModal" tabindex="-1" aria-labelledby="createDocenteModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-body-secondary">
                    <h5 class="modal-title fs-6" id="createDocenteModalLabel">Crear Nuevo Docente</h5>
                    <span class="material-symbols-outlined mx-2 fs-5">person_add</span>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store" class="validation-form">
                        <div class="mb-3">
                            <label for="nombres" class="form-label mb-0">Nombres</label>
                            <x-input
                                id="nombres"
                                type="text"
                                wire:model.defer="nombres"
                                autocomplete="given-name"
                                required data-parsley-pattern="^([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ']+\s?)+([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ'])$"
                                data-parsley-length="[3, 40]"
                                data-parsley-trigger="keyup">
                            </x-input>
                            <x-input-error for="nombres" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="documento" class="form-label mb-0">Documento</label>
                            <x-input id="documento" type="text"  reqired autocomplete="off" wire:model.defer="documento" reqired autocomplete="documento" required data-parsley-length="[8, 10]" data-parsley-type="digits" data-parsley-trigger="keyup" />
                            <x-input-error for="documento" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label mb-0" >Teléfono</label>
                            <x-input id="telefono"  reqired autocomplete="tel" wire:model.defer="telefono" required data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-type="digits" data-parsley-trigger="keyup" />
                            <x-input-error for="telefono" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label mb-0" >Dirección</label>
                            <x-input id="direccion"  reqired autocomplete="street-address" type="text" wire:model.defer="direccion"
                            required data-parsley-pattern="/[A-Za-z0-9\s.#ªN°n°-]*$/" data-parsley-length="[5, 40]" data-parsley-trigger="keyup" />
                            <x-input-error for="direccion" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="lugarDeResidencia" class="form-label mb-0">Lugar de Residencia</label>
                            <x-input id="lugarDeResidencia" type="text"  reqired autocomplete="off" wire:model.defer="lugarDeResidencia" required data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$" data-parsley-length="[3, 40]" data-parsley-trigger="keyup" />
                            <x-input-error for="lugarDeResidencia" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label mb-0">Correo Electrónico</label>
                            <x-input type="email" id="email"  reqired autocomplete="email" wire:model.defer="email" required data-parsley-type="email" data-parsley-maxlength="50" data-parsley-trigger="keyup" />
                            <x-input-error for="email" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="contraseña-nueva" class="form-label mb-0">{{ __('Nueva contraseña') }}</label>
                            <img class="img-password cursor-pointer"  data-input="contraseña-nueva" role="button" width="" height="" src="{{ asset('images/ojo.png') }}" alt="" />
                            <x-input class=" input-password" autocomplete="new-password" id="contraseña-nueva" type="password" placeholder="10 caracteres, 1 especial, 1 mayuscula y 1 numero"  wire:model.defer="password" autocomplete="new-password" required autocomplete="nombres"
                            required data-parsley-pattern="^(?=(.*[A-Z]))(?=(.*\d))(?=(.*[^\w\s])).{10,}$" data-parsley-trigger="keyup" />
                            <x-input-error for="contraseña-nueva" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="confirmar-contraseña" class="form-label mb-0">{{ __('Confirmar contraseña') }}</label>
                            <img class="img-password cursor-pointer" data-input="confirmar-contraseña" role="button" width="" height="" src="{{ asset('images/ojo.png') }}" alt="" />
                            <x-input class=" input-password" id="confirmar-contraseña" type="password" wire:model.defer="password_confirmation" autocomplete="new-password" required data-parsley-equalto="#contraseña-nueva" data-parsley-trigger="keyup" />
                            <x-input-error for="confirmar-contraseña" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="id_perfil" class="form-label mb-0">Perfil</label>
                            <select wire:model="id_perfil" class="form-select form-select-sm" id="id_perfil" required data-parsley-required data-parsley-trigger="keyup">
                                <option value="" selected>Seleccione un perfil...</option>
                                @foreach($perfiles as $perfil)
                                    <option value="{{ $perfil->id_perfil }}">{{ $perfil->perfil }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="id_perfil" class="mt-2" />
                        </div>
                        <hr>
                        <div class="mb-3 form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                wire:model.defer="id_estadoUsuario"
                                id="id_estadoUsuario"
                                checked>
                            <label class="form-check-label" for="id_estadoUsuario">Permitir inicio de sesión</label>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="role" class="form-label mb-0">Roles</label>
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value="{{ $role->id_role }}"
                                        wire:model.defer="selectedRoles"
                                        id="role_{{ $role->id_role }}"
                                        name="roles[]"
                                        data-parsley-required
                                        data-parsley-required-message="Debes seleccionar al menos un rol."
                                        data-parsley-errors-container="#roles-error"
                                        data-parsley-trigger="keyup">
                                    <label class="form-check-label" for="role_{{ $role->id_role }}">
                                        {{ $role->display_name }}
                                    </label>
                                </div>
                            @endforeach
                            <div id="role" class="mt-2 text-danger"></div>
                            <x-input-error for="role" class="mt-2" />
                        </div>
                        <div class="modal-footer bg-body-secondary">
                            <x-button>Crear Docente</x-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal edit docente -->
    <div wire:ignore.self class="modal fade" id="editDocenteModal" tabindex="-1" aria-labelledby="editDocenteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-body-secondary">
                    <h5 class="modal-title fs-6" id="editDocenteModalLabel">Editar Docente</h5>
                    <span class="material-symbols-outlined fs-5 mx-1">person_edit</span>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update" class="validation-form">
                        <div class="mb-3">
                            <label for="editNombres" class="form-label mb-0">Nombres</label>
                            <x-input
                                class="fw-light"
                                id="editNombres"
                                type="text"
                                wire:model.defer="nombres"
                                autocomplete="given-name"
                                required
                                data-parsley-pattern="^([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ']+\s?)+([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ'])$"
                                data-parsley-length="[3, 40]"
                                data-parsley-trigger="keyup">
                            </x-input>
                            <x-input-error for="nombres" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="editDocumento" class="form-label mb-0">Documento</label>
                            <x-input
                                class="fw-light"
                                id="editDocumento"
                                type="text"
                                wire:model.defer="documento"
                                autocomplete="off"
                                required
                                data-parsley-length="[8, 10]"
                                data-parsley-type="digits"
                                data-parsley-trigger="keyup">
                            </x-input>
                            <x-input-error for="documento" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="editTelefono" class="form-label mb-0">Teléfono</label>
                            <x-input
                                class="fw-light"
                                id="editTelefono"
                                type="text"
                                wire:model.defer="telefono"
                                autocomplete="tel"
                                required
                                data-parsley-minlength="10"
                                data-parsley-maxlength="10"
                                data-parsley-type="digits"
                                data-parsley-trigger="keyup">
                            </x-input>
                            <x-input-error for="telefono" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="editDireccion" class="form-label mb-0">Dirección</label>
                            <x-input
                                class="fw-light"
                                id="editDireccion"
                                type="text"
                                wire:model.defer="direccion"
                                autocomplete="street-address"
                                required
                                data-parsley-pattern="/[A-Za-z0-9\s.#ªN°n°-]*$/"
                                data-parsley-length="[5, 40]"
                                data-parsley-trigger="keyup">
                            </x-input>
                            <x-input-error for="direccion" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="editLugarDeResidencia" class="form-label mb-0">Lugar de Residencia</label>
                            <x-input
                                class="fw-light"
                                id="editLugarDeResidencia"
                                type="text"
                                wire:model.defer="lugarDeResidencia"
                                required
                                data-parsley-pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$"
                                data-parsley-length="[3, 40]"
                                data-parsley-trigger="keyup">
                            </x-input>
                            <x-input-error for="lugarDeResidencia" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label mb-0">Correo Electrónico</label>
                            <x-input
                                class="fw-light"
                                id="editEmail"
                                type="email"
                                wire:model.defer="email"
                                autocomplete="email"
                                required
                                data-parsley-type="email"
                                data-parsley-maxlength="50"
                                data-parsley-trigger="keyup">
                            </x-input>
                            <x-input-error for="email" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="editContraseña-nueva" class="form-label mb-0">{{ __('Nueva contraseña') }}</label>
                            <img class="img-password cursor-pointer"  data-input="editContraseña-nueva" role="button" width="" height="" src="{{ asset('images/ojo.png') }}" alt="" />
                            <x-input class=" input-password" autocomplete="new-password" id="editContraseña-nueva" type="password" placeholder="10 caracteres, 1 especial, 1 mayuscula y 1 numero"  wire:model.defer="password" autocomplete="new-password" autocomplete="nombres"
                            data-parsley-pattern="^(?=(.*[A-Z]))(?=(.*\d))(?=(.*[^\w\s])).{10,}$" data-parsley-trigger="keyup" />
                            <x-input-error for="password" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="editConfirmar-contraseña" class="form-label mb-0">{{ __('Confirmar contraseña') }}</label>
                            <img class="img-password cursor-pointer" data-input="editConfirmar-contraseña" role="button" width="" height="" src="{{ asset('images/ojo.png') }}" alt="" />
                            <x-input class=" input-password" id="editConfirmar-contraseña" type="password" wire:model.defer="password_confirmation" autocomplete="new-password" data-parsley-equalto="#editContraseña-nueva" data-parsley-trigger="keyup" />
                            <x-input-error for="password_confirmation" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="editIdPerfil" class="form-label mb-0">Perfil</label>
                            <select
                                id="editIdPerfil"
                                class="form-select form-select-sm"
                                wire:model.defer="id_perfil"
                                required
                                data-parsley-trigger="keyup">
                                <option value="" selected>Seleccione un perfil...</option>
                                @foreach($perfiles as $perfil)
                                    <option value="{{ $perfil->id_perfil }}">{{ $perfil->perfil }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="id_erfil" class="mt-2" />
                        </div>
                        <hr>
                        <div class="mb-3 form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                wire:model.defer="id_estadoUsuario"
                                id="editEstadoUsuario">
                            <label class="form-check-label" for="editEstadoUsuario">Permitir inicio de sesión</label>
                            <x-input-error for="id_estadoUsuario" class="mt-2" />
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="editRole" class="form-label mb-0">Roles</label>
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value="{{ $role->id_role }}"
                                        wire:model.defer="selectedRoles"
                                        id="editRole_{{ $role->id_role }}"
                                        name="roles[]">
                                    <label class="form-check-label" for="editRole_{{ $role->id_role }}">
                                        {{ $role->display_name }}
                                    </label>
                                </div>
                            @endforeach
                            <x-input-error for="selectedRoles" class="mt-2" />
                        </div>
                        <div class="modal-footer bg-body-secondary">
                            <x-button>Guardar Cambios</x-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        //evento para mostrar notificaciones de exito
        Livewire.on('toast-success', ({ message }) => {
            showToast(message); // Llama a tu función de SweetAlert2
        });


         // Lógica evento para eliminar con SweetAlert
        Livewire.on('show-delete-confirmation', (event) => {
            //console.log("Evento recibido:", event); // Imprime todo el evento

            const { docenteId } = event[0]; // Extraer el ID del docente con [0]

            //console.log("Docente ID enviado:", docenteId); // Verifica el valor
            const title = "¿Estás seguro?";
            const text = "Esta acción eliminará al docente de forma permanente.";
            const confirmText = "Sí, eliminar";
            const cancelText = "Cancelar";

            // Mostrar la ventana modal de SweetAlert, showConfirmation es la export const del archivo reutilizar-alertas.js
            showConfirmation(title, text, confirmText, cancelText, () => {
                // Confirmar la eliminación llamando a un método de Livewire
                Livewire.dispatch('delete-docente', { docenteId });
            });
        });

    });

</script>
