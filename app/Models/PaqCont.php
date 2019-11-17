<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaqCont extends Model
{
	protected $table="paqcont";

    protected $fillable = [
    	'paquete', 'control', 'paciente','estatus'
    ];
}