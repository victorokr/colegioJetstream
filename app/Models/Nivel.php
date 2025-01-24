<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'nivel';
    protected $primaryKey = 'id_nivel';
    protected $fillable = ['nivel'];
}
