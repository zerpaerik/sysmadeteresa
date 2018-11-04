<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioMaterial extends Model
{
    protected $table = 'servicio_materiales';
    protected $fillable = [
    	'servicio_id', 'material_id', 'cantidad'
    ];
    public $timestamps = false;

    public function material()
    {
    	return $this->hasOne('App\Models\Existencias\Producto', 'id', 'material_id');
    }

    public function servicio()
    {
    	return $this->hasOne('App\Models\Servicios', 'id','servicio_id');
    }
}
