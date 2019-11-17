<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaqLab extends Model
{
	protected $table="paqlab";

    protected $fillable = [
    	'paquete', 'lab', 'paciente','estatus'
    ];
}