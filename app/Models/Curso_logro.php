<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso_logro extends Model
{
    protected $table = 'curso_logro';
    protected $primaryKey = 'id_cursoLogro';
    protected $fillable = ['id_logro','id_curso'];
}
