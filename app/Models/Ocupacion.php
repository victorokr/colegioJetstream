<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    protected $table = 'ocupacion';
    protected $primaryKey = 'id_ocupacion';
    protected $fillable = ['ocupacion'];
}
