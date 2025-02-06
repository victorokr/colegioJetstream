<?php

namespace App\Livewire\Docentes;


use Carbon\Carbon;
use App\Models\Role;
use App\Models\Perfil;
use App\Models\Docente;
use Livewire\Component;
use App\Models\Estadousuario;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination; // Aquí importas el trait de Livewire

class ListaDocentes extends Component
{
    //public $docentes; //se le pasa al metodo mount
    public $perfiles;
    public $estadoUsuarios;
    public $id_estadousuario;
    public $roles; // Todos los roles disponibles
    public $selectedRoles = []; // Roles seleccionados (como array de IDs)
    //create form
    public $nombres, $documento, $telefono, $direccion, $lugarDeResidencia, $email, $password, $password_confirmation, $id_perfil, $id_estadoUsuario;

    public $docenteEdit;//datos del docente a editar
    public $docenteId;//necesario para la regla de validacion ignore
    protected $listeners = [
        'refreshDocentes',
        'delete-docente' => 'deleteDocente',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap'; // Configurar Bootstrap como tema
    public $search = ''; // Campo de búsqueda opcional



    public function mount()
    {   //estas propiedades alimentan a los modales y el metodo render()
        //$this->docentes       = Docente::all(); // Recupera todos los docentes
        $this->perfiles       = Perfil::all();
        $this->estadoUsuarios = Estadousuario::all();
        $this->id_estadoUsuario = true; // Por defecto, encendido
        $this->roles = Role::where('id_role', '!=', 2)->get(); // Excluye el rol "responsable" (ID = 2)
    }

    public function refreshDocentes()
    {
        $this->docentes = Docente::all(); // Actualiza la lista de docentes
    }
//-------------------------------------------------------------------------------------
    //Backend (Livewire): Se emite los eventos desde cualquier componente livewire, especificando el modalId correcto para que control-modales.js los escuche
    public function openCreateModal()
    {
        $this->resetForm();
        $this->dispatch('show-modal', modalId: 'createDocenteModal');
    }
    public function openEditModal($docenteId)
    {
        $this->docenteId = $docenteId;//para el ignore validation
        // Cargar los datos del docente
        $docenteEdit = Docente::findOrFail($docenteId);
            $this->fill([
                'nombres' => $docenteEdit->nombres,
                'documento' => $docenteEdit->documento,
                'telefono' => $docenteEdit->telefono,
                'direccion' => $docenteEdit->direccion,
                'lugarDeResidencia' => $docenteEdit->lugarDeResidencia,
                'email' => $docenteEdit->email,
                'password' =>'',
                'id_perfil' => $docenteEdit->id_perfil,
                'selectedRoles' => $docenteEdit->roles->pluck('id_role')->toArray(),
                'id_estadoUsuario' => $docenteEdit->id_estadoUsuario == 1, //convertir a boleano para que cargue el valor real del la base de datos en el form edit
            ]);
        $this->dispatch('show-modal', modalId: 'editDocenteModal');
    }

    public function openDeleteModal($docenteId)
    {
        $this->dispatch('show-delete-confirmation', ['docenteId' => $docenteId]);
    }

    public function closeModal($modalId)
    {
        $this->dispatch('hide-modal', modalId: $modalId);
    }
    //------------------------------------------------------------------------------




    public function resetForm()
    {
        $this->nombres = '';
        $this->documento = '';
        $this->telefono = '';
        $this->direccion = '';
        $this->password = '';
        $this->lugarDeResidencia = '';
        $this->email = '';
    }

    public function store()
    {
        // dd($this->all());
        // dd($this->id_estadoUsuario);
        $this->validate([
            'nombres' => ['required','regex:/^([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+\s?)+([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])$/','min:3','max:40'],//valida solo letras
            'documento' => ['required','digits_between:8,10','unique:docente,documento'],
            'telefono' => ['required','digits:10'],
            'direccion' => ['required','min:7','max:35'],
            'password' => ['required','confirmed','min:10','max:20','regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d\p{P}\p{S}\s@#^&*()_\-+=!{}\[\]:;"\'<>.,?\/\\|~]{10,}$/'],//debe contener un numero, minuscula y mayuscula
            'lugarDeResidencia' => ['required','regex:/^([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+\s?)+([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])$/','min:3','max:40'],//valida solo letras
            'email' => ['required','max:50','unique:docente,email'],
            'id_perfil'   =>['required'],
            'id_estadoUsuario' => ['required','boolean'],
            'selectedRoles' => ['required','array','min:1'], // Asegura al menos un rol seleccionado
            'selectedRoles.*' => ['exists:role,id_role'], // Valida que cada ID de rol exista

        ]);

        $docente = Docente::create([
            'nombres' => $this->nombres,
            'documento' => $this->documento,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'password' => bcrypt($this->password),
            'lugarDeResidencia' => $this->lugarDeResidencia,
            'email' => $this->email,
            'id_estadoUsuario' => $this->id_estadoUsuario ? 1 : 2, //convierte a 1 o 2
            'id_perfil' => $this->id_perfil,
        ]);

        $docente->roles()->sync($this->selectedRoles);// Asociar roles usando sync

        $this->resetForm();
        $this->dispatch('hide-modal', modalId: 'createDocenteModal');
        $this->refreshDocentes(); // Actualiza la lista de docentes

        //emite el evento sweetalert
        //Log::info('Evento dispatch ejecutado.');
        $this->dispatch('toast-success', message: 'Docente creado exitosamente.');
        //Log::info('Evento toast-success despachado.');

    }

//----------------------------------------------------------------------------------------------------------------------
    public function update()
    {
        $validatedData = $this->validate([

            'nombres' => ['required','regex:/^([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+\s?)+([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])$/','min:3','max:40'],//valida solo letras
            'documento' => ['required','digits_between:8,10', Rule::unique('docente')->ignore($this->docenteId, 'id_docente')],
            'telefono' => ['required','digits:10'],
            'direccion' => ['required','min:7','max:35'],
            'password' => ['nullable','confirmed','min:10','max:20','regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d\p{P}\p{S}\s@#^&*()_\-+=!{}\[\]:;"\'<>.,?\/\\|~]{10,}$/'],//debe contener un numero, minuscula y mayuscula
            'lugarDeResidencia' => ['required','regex:/^([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+\s?)+([A-Za-zÁÉÍÓÚñáéíóúÑ]?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])$/','min:3','max:40'],//valida solo letras
            'email' => ['required','email','max:50', Rule::unique('docente')->ignore($this->docenteId, 'id_docente')],
            'id_perfil'   =>['required'],
            'id_estadoUsuario' => ['required','boolean'],
            'selectedRoles' => ['required','array','min:1'], // Asegura al menos un rol seleccionado
            'selectedRoles.*' => ['exists:role,id_role'], // Valida que cada ID de rol exista
        ]);



        $docente = Docente::findOrFail($this->docenteId);// Obtener el docente

        // Si el campo de contraseña no está vacío, encriptarla
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']); // Eliminar la contraseña de los datos validados
        }
        // dd($validatedData);
        // Actualizar el docente con los datos validados
        $docente->update([
            'nombres' => $validatedData['nombres'],
            'documento' => $validatedData['documento'],
            'telefono' => $validatedData['telefono'],
            'direccion' => $validatedData['direccion'],
            'lugarDeResidencia' => $validatedData['lugarDeResidencia'],
            'email' => $validatedData['email'],
            'id_perfil' => $validatedData['id_perfil'],
            'id_estadoUsuario' => $validatedData['id_estadoUsuario'] ? 1 : 2,
        ]);


        $docente->roles()->sync($validatedData['selectedRoles']);

        //$this->dispatch('hide-modal', ['modalId' => 'editDocenteModal']);
        $this->dispatch('hide-modal', modalId: 'editDocenteModal');
        $this->refreshDocentes(); // Actualiza la lista de docentes
        $this->dispatch('toast-success', message: 'Docente actualizado exitosamente.');
    }

//--------------------------------------------------------------------------------------------------------------

    public function canDelete($docente)
    {
        $currentDate = Carbon::now('America/Bogota');
        //$currentDate = new Carbon('2026-01-24');//fecha de prueba
        //dd($currentDate);
        $oneYearAgo = (clone $currentDate)->subYear();



        return  $docente->id_estadoUsuario === 2 && $docente->updated_at <= $oneYearAgo;
        // $canDelete = $docente->id_estadoUsuario === 2 && $docente->updated_at <= $oneYearAgo;

        // dd([
        //     'currentDate' => $currentDate,
        //     'oneYearAgo' => $oneYearAgo,
        //     'updatedAt' => $docente->updated_at,
        //     'canDelete' => $canDelete,
        // ]);

        // return $canDelete;
    }



    public function deleteDocente($docenteId)
    {
        // Asignar el parámetro a la propiedad solo si es necesario
        $this->docenteId = $docenteId;

        // Depurar para verificar que el parámetro llega correctamente
        //dd($this->docenteId);

        $docente = Docente::findOrFail($this->docenteId);

        if ($this->canDelete($docente)) {
            $docente->delete();

            $this->refreshDocentes(); // Actualiza la lista de docentes
            $this->dispatch('docente-deleted');
        }
    }

//----------------------------------------------------------------------------------------
    public function updatingSearch()
    {
        $this->resetPage(); // Reiniciar la paginación al cambiar el término de búsqueda
    }

    public function render()
    {
        // Carga los docentes con relaciones y evita N+1 consultas
        $docentes = Docente::with(['perfil', 'roles', 'estadousuario'])
        ->where(function ($query) {
            if ($this->search) {
                $query->where('nombres', 'like', '%' . $this->search . '%')
                      ->orWhere('documento', 'like', '%' . $this->search . '%');
            }
        })
        ->paginate(10);
        //dd($docentes);


        // Retorna la vista con todas las variables necesarias y this es para reutilizar las propiedades ya cargadas del metodo mount()
        return view('livewire.docentes.lista-docentes', [
            'docentes' => $docentes,
            'perfiles' => $this->perfiles,
            'estadoUsuarios' => $this->estadoUsuarios,
            'roles' => $this->roles,
        ])->layout('layouts.app');
    }









}
