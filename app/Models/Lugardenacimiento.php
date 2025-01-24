<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lugardenacimiento extends Model
{
    protected $table = 'lugardenacimiento';
    protected $primaryKey = 'id_lugarDeNacimiento';
    protected $fillable = ['lugarDeNacimiento'];
}
