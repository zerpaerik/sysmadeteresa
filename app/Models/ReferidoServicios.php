<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferidoServicios extends Model
{
    protected $table = 'referido_servicios';
    protected $fillable = ['paciente', 'servicio', 'usuario', 'estatus','es_s','es_l'];
    
  
}
