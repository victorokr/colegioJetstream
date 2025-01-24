<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logro extends Model
{
    protected $table = 'logro';
    protected $primaryKey = 'id_logro';
    protected $fillable = ['logro1','logro2','logro3','logro4','id_docente','id_periodo','id_asignatura','id_grado'];



    public function docente()
    {
        return $this->belongsTo('App\Models\Docente','id_docente');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo','id_periodo');
    }

    public function asignatura()
    {
        return $this->belongsTo('App\Models\Asignatura','id_asignatura');
    }

    public function grado()
    {
        return $this->belongsTo('App\Models\Grado','id_grado');
    }


    public function scopeConsultaGrado($query, $grado)
    {
        if($grado)
        return $query->whereHas("grado", function ($query) use ($grado){
            $query->where('id_grado','LIKE', "%$grado%");
        });
    }

    public function scopeConsultaPeriodo($query, $periodo)
    {
        if($periodo)
        return $query->whereHas("periodo", function ($query) use ($periodo){
            $query->where('id_periodo','LIKE', "%$periodo%");
        });
    }

    public function scopeConsultaAsignatura($query, $asignatura)
    {
        if($asignatura)
        return $query->whereHas("asignatura", function ($query) use ($asignatura){
            $query->where('id_asignatura','LIKE', "%$asignatura%");
        });
    }

    // public function cursos()
    // {
    //     return $this->hasManyThrough('App\Listado','App\Curso','id_curso','id_listado');
    // }

}
