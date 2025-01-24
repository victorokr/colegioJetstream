<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'asignatura';
    protected $primaryKey = 'id_asignatura';
    protected $fillable = ['asignatura'];

    
public function scopeConsultaAsignatura($query, $busquedaAsignatura)
{
    if($busquedaAsignatura)
    return $query->where('asignatura','LIKE',"%$busquedaAsignatura%");
}


public function logros()
    {
        return $this->hasMany('App\Models\Logro','id_logro');
    }
    


}
