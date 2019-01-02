<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadosLaboratorios extends Model
{
    protected $fillable = [
    	'id_atencion', 'id_laboratorio', 'informe'
    ];
}