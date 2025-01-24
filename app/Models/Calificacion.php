<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificacion';
    protected $primaryKey = 'id_calificacion';
    protected $fillable = ['nota1','nota2','nota3','nota4','id_asignatura','id_alumno','id_curso','id_periodo','id_docente','id_grado','id_logro','id_promedio','id_observacion'];


    public function asignatura()
    {
        return $this->belongsTo('App\Models\Asignatura','id_asignatura');
    }

    public function alumno()
    {
        return $this->belongsTo('App\Models\Alumno','id_alumno');
    }

    public  function curso()
    {
        return $this->belongsTo('App\Models\Curso','id_curso');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo','id_periodo');
    }

    public function docente()
    {
        return $this->belongsTo('App\Models\Docente','id_docente');
    }

    public function logro()
    {
        return $this->belongsTo('App\Models\Logro','id_logro');
    }

    public function promedio()
    {
        return $this->belongsTo('App\Models\Promedio','id_promedio');
    }

    public  function grado()
    {
        return $this->belongsTo('App\Models\Grado','id_grado');
    }
    public  function observacion()
    {
        return $this->belongsTo('App\Models\Observacion','id_observacion');
    }


    



    public function scopeConsultaGrado($query, $grado)
    {
        if($grado)
        return $query->whereHas("grado", function ($query) use ($grado){
            $query->where('id_grado','LIKE', "%$grado%");
        });
    }

   
    public function scopeConsultaAsignatura($query, $asignatura)
    {
    if($asignatura)
    return $query->where('id_asignatura','LIKE',"%$asignatura%");
    }






    public function scopeConsultaCurso($query, $curso)
    {
    if($curso)
    return $query->where('id_curso','LIKE',"%$curso%");
    }

    public function scopeConsultaPeriodo($query, $periodo)
    {
    if($periodo)
    return $query->where('id_periodo','LIKE',"%$periodo%");
    }

    public function scopeConsulta_año($query, $año)
    {
    if($año)
    return $query->where('created_at','LIKE',"%$año%");
    }
    


    public function scopeConsultaNombre($query, $nombre)
    {
        if($nombre)
        return $query->whereHas("alumno", function ($query) use ($nombre){
            $query->where('nombres','LIKE', "%$nombre%");
        });
    }

    // public function scopeConsultaNombre($query, $nombre)
    // {
    // if($nombre)
    // return $query->where('id_alumno','LIKE',"%$nombre%");
    // }


    // public function scopeAsignatura($query, $asignatura)
    // {
    //     if($asignatura)
    //     return $query->where('id_asignatura','LIKE',"%$asignatura%")
    //                  ->orWhere('id_alumno'  ,'LIKE',"%$asignatura%")
    //                  ;
    // }
    



}
