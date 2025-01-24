<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listado extends Model
{
    protected $table = 'listado';
    protected $primaryKey = 'id_listado';
    protected $fillable = ['id_asignatura','id_curso','id_docente'];

    

    public function curso()
    {
        return $this->belongsTo('App\Models\Curso','id_curso');
    }

    public function asignatura()
    {
        return $this->belongsTo('App\Models\Asignatura','id_asignatura');
    }

    public function docente()
    {
        return $this->belongsTo('App\Models\Docente','id_docente');
    }


    public function scopeConsultaCurso($query, $busquedaCurso)
    {
    if($busquedaCurso)
    return $query->where('id_curso','LIKE',"%$busquedaCurso%");
    }


}