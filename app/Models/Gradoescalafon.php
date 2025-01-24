<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gradoescalafon extends Model
{
    protected $table = 'gradoescalafon';
    protected $primaryKey = 'id_escalafon';
    protected $fillable = ['escalafon'];
}
