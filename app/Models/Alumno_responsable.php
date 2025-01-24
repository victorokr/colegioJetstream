<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno_responsable extends Model
{
    protected $table = 'alumno_responsable';
    protected $primaryKey = 'id_alumnoResponsable';
    protected $fillable = ['id_alumno','id_responsable'];
}
