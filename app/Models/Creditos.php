<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creditos extends Model
{
    protected $fillable = [
    	'id_atencion', 'origen', "descripcion",'monto','tipo_ingreso','id_sede','id_metodo','id_event'
    ];
}
