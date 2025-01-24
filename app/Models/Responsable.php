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

class Responsable extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'responsable';
    protected $primaryKey = 'id_responsable';

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
        'id_parentesco',
        'id_estadoUsuario',
        'id_tipoDocumento'


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
        return $this->belongsToMany(Role::class, 'responsable_role','id_responsable','id_role');//el primero pertenece a la tabla pivot, 2do a la tabla empleado para evitar que eloquen lo busque en orden alfabetico, 3ro el id de la tabla a relacionar, tabla role.
    }


    public function tipoDeDocumento()
    {
        return $this->belongsTo('App\Models\Tipodocumento','id_tipoDocumento');
    }


    public function parentesco()
    {
        return $this->belongsTo('App\Models\Parentesco','id_parentesco');
    }

    public function responsabledos()
    {
        return $this->belongsToMany('App\Models\Responsabledos','Responsabledos_responsable','id_responsable','id_responsabledos');
    }

    public function ocupacion()
    {
        return $this->belongsToMany('App\Models\Ocupacion','Responsable_ocupacion','id_responsable','id_ocupacion');
    }

    public function estadousuario()
    {
        return $this->belongsTo('App\Models\Estadousuario','id_estadoUsuario');
    }



}
