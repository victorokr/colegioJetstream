<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $table = 'observacion';
    protected $primaryKey = 'id_observacion';
    protected $fillable = ['observaciones','id_asignatura','id_alumno'];



    public function asignatura()
    {
        return $this->belongsTo('App\Models\Asignatura','id_asignatura');
    }

    public function alumno()
    {
        return $this->belongsTo('App\Models\Alumno','id_alumno');
    }


    public function calificacion()
    {
        return $this->hasOne(Calificacion::class,'id_observacion');
    }

  
    //---------------------------------------------------------------------------scopes

    public function scopeConsultaAño($query, $año)
    {
    if($año)
    return $query->where('created_at','LIKE',"%$año%");
    }
    


    public function scopeConsultaAlumno($query, $alumno)
    {
        if($alumno)
        return $query->whereHas("alumno", function ($query) use ($alumno){
            $query->where('nombres','LIKE', "%$alumno%");
        });
    }





}
