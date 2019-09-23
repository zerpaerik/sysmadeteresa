<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descarga extends Model
{
	protected $table="descargar_mat";

    protected $fillable = [
    	'producto', 'cantidad', 'usuario','observacion','almacen','sede'
    ];
}