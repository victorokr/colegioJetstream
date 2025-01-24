<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model
{
    protected $table = 'parentesco';
    protected $primaryKey = 'id_parentesco';
    protected $fillable = ['parentesco'];
}
