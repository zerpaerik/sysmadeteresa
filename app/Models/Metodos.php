<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metodos extends Model
{
    protected $fillable = [
    	'id_paciente', 'id_producto', 'monto','proximo','id_usuario','estatus','personal','es_delete','tipopago','detalle_llamada'
    ];

   
}
