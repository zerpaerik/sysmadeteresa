<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    protected $fillable = ["dni", "nombres", "apellidos", "direccion", "provincia", "telefono", "fechanac", "gradoinstruccion", "ocupacion", "edocivil", "estatus", "historia", "distrito","usuario"];

    public function atenciones()
    {
    	return $this->hasMany('App\Models\Atenciones', 'id_paciente', 'id');
    }
}
