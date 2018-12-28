<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadosServicios extends Model
{
    protected $fillable = [
    	'id_atencion', 'id_servicio', 'informe', 'user_id'
    ];
}