<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $fillable = [
    	'id','detalle', 'precio', 'porcentaje','estatus', 'por_per', 'por_tec','usuario','programa'
    ];

    public function atenciones()
    {
    	return $this->hasMany('App\Models\Atenciones', 'id_servicio', 'id');
    }

    public function materiales()
    {
    	return $this->hasMany('App\Models\ServicioMaterial', 'servicio_id', 'id');
    }
}
