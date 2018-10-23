<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $fillable = [
    	'id','detalle', 'precio', 'porcentaje'
    ];

    public function atenciones()
    {
    	return $this->hasMany('App\Models\Atenciones', 'id_servicio', 'id');
    }
}
