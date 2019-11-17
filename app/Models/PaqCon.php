<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaqCon extends Model
{
	protected $table="paqcon";

    protected $fillable = [
    	'paquete', 'consulta', 'paciente','estatus','num'
    ];
}