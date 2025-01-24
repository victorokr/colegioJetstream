<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crearalumno extends Model
{
    protected $table = 'alumno';
    protected $primaryKey = 'id_alumno';
    protected $fillable = ['nombres','documento','telefono',
    'email','direccion','lugarDeResidencia','fechaDeNacimiento',
    'id_tipoDocumento','id_lugarDeNacimiento','id_factorRH','id_eps'];

    public function factorrh()
    {
        return $this->belongsTo('App\Models\FactorRH','id_factorRH');
    }

    public function eps()
    {
        return $this->belongsTo('App\Models\Eps','id_eps');
    }

    

    public function lugarDeNacimiento()
    {
        return $this->belongsTo('App\Models\Lugardenacimiento','id_lugarDeNacimiento');
    }

    public function tipoDeDocumento()
    {
        return $this->belongsTo('App\Models\Tipodocumento','id_tipoDocumento');
    }

    public function responsable()
    {
        return $this->belongsToMany('App\Models\Responsable','alumno_responsable','id_alumno','id_responsable');
    }
}
