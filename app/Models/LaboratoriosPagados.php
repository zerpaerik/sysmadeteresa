<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaboratoriosPagados extends Model
{
    protected $fillable = [
    	'laboratorio', 'analisis','monto','usuario','sede','paciente','gasto','atencion'
    	];

  
}
