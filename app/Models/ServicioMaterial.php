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
    	return $this->hasOne('App\Models\Productos', 'material_id');
    }
}
