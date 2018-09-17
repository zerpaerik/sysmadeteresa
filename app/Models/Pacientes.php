<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    protected $fillable = [
    	'dni', 'nombres', 'apellidos','direccion','provincia','distrito','telefono','fechanac','gradoinstrucion','ocupacion','estatus','edocivil','historia'
    ];
}
