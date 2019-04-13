<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
	protected $table="ventas";

    protected $fillable = [
    	'id_producto', 'cantidad', 'monto','id_usuario','sede'
    ];

   
}
