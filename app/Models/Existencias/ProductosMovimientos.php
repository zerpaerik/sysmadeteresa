<?php

namespace App\Models\Existencias;

use Illuminate\Database\Eloquent\Model;

class ProductosMovimientos extends Model
{
	protected $table="productos_movimientos";

    protected $fillable = [
    	'id_producto','cantidad','usuario','accion','origen','alm1','alm2'
    ];

   
}
