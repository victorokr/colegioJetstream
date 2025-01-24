<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadousuario extends Model
{
    use HasFactory;
    protected $table = 'estado_usuario';
    protected $primaryKey = 'id_estadoUsuario';
    protected $fillable = ['estadoUsuario'];
}
