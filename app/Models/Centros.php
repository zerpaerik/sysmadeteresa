<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centros extends Model
{
    protected $fillable = [
    	'name', 'direccion', "referencia","estatus","usuario"
    ];
}
