<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    protected $fillable = [
    	'name', 'laboratorio', 'preciopublico','costlab','material','tiempo','porcentaje','estatus','usuario'
    ];

    public function Atenciones()
    {
    	return $this->hasMany('App\Models\Atenciones', 'id_laboratorio', 'id');
    }
}
