<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente_role extends Model
{
    use HasFactory;
    protected $table = 'docente_role';
    protected $primaryKey = 'id_docenteRole';
    //protected $fillable = [''];
}
