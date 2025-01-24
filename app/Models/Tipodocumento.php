<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
{
    protected $table = 'tipodocumento';
    protected $primaryKey = 'id_tipoDocumento';
    protected $fillable = ['tipoDocumento'];
}
