<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atenciones extends Model
{
    protected $fillable = [
    	'id_paciente', 'origen', 'origen_usuario','id_servicio','id_laboratorio','es_servicio','es_laboratorio','monto','porcentaje','tipopago','abono','pagado_lab','pagado_com','resultado','fecha_pago_lab','fecha_pago_comision','id_sede','estatus','created_at','updated_at'
    ];
}
