<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialCobros extends Model
{
	protected $table="historialcobros";

    protected $fillable = [
    	'id_atencion', 'id_paciente', 'monto','abono','pendiente'
    ];
}