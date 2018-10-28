<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paquetes extends Model
{
    protected $fillable = [
    	'detalle', 'precio','porcentaje'
    ];

    public function servicios()
    {
    	return $this->hasMany('App\Models\PaqueteServ','paquete_id');
    }
}
