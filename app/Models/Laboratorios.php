<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratorios extends Model
{
    protected $fillable = [
    	'name', 'direccion', 'referencia','estatus','usuario'
    ];
}