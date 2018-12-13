<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historiales extends Model
{
	protected $table="historial";

    protected $fillable = [
    	'accion', 'origen', 'id_usuario','detalle','sede'
    ];

   
}
