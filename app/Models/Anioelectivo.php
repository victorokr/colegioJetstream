<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anioelectivo extends Model
{
    protected $table = 'añoelectivo';
    protected $primaryKey = 'id_añoElectivo';
    protected $fillable = ['añoElectivo'];
}
