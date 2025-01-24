<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
    protected $table = 'eps';
    protected $primaryKey = 'id_eps';
    protected $fillable = ['EPS'];
}
