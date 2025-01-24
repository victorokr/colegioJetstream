<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodo';
    protected $primaryKey = 'id_periodo';
    protected $fillable = ['periodo','fechainicio','fechafin'];
}
