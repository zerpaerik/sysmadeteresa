<?php

namespace App\Models\Pacientes;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = ["dni", "nombres", "apellidos", "direccion", "provincia", "telefono", "fechanac", "gradoinstruccion", "ocupacion", "edocivil", "estatus", "historia", "distrito"];
}
