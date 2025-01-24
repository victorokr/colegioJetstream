<?php

namespace App\Models;

use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;

use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


//se agregó implements MustVerifyEmail para verificar el email cuando cambia en profile
class Docente extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'docente';
    protected $primaryKey = 'id_docente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombres',
        'documento',
        'telefono',
        'direccion',
        'email',
        'password',
        'lugarDeResidencia',
        'id_perfil',
        'id_estadoUsuario',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    protected $dates = ['updated_at','created_at']; //Esto asegura que las fechas sean tratadas como instancias de Carbon

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }






    public function hasRoles(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('Nombre', $role)) {
                return true;
            }
        }

        return false;
    }








    public function roles()
    {
        return $this->belongsToMany(Role::class, 'docente_role', 'id_docente', 'id_role');
    }



    public function perfil()
    {
        return $this->belongsTo('App\Models\Perfil','id_perfil');
    }



    public function estadousuario()
    {
        return $this->belongsTo('App\Models\Estadousuario','id_estadoUsuario');
    }


}
