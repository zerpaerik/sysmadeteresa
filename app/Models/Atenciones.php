<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atenciones extends Model
{
    protected $fillable = [
    	'id_paciente', 'origen', 'origen_usuario','id_servicio','id_laboratorio','es_servicio','es_laboratorio','monto','porcentaje','tipopago','abono','pagado_lab','pagado_com','resultado','fecha_pago_lab','fecha_pago_comision','id_sede','estatus','created_at','updated_at'
    ];

    public function servicio()
    {
    	return $this->hasOne('App\Models\Servicios','id', 'id_servicio');
    }

    public function sede()
    {
    	return $this->hasOne('App\Models\Config\Sede','id', 'id_sede');
    }

    public function paciente()
    {
    	return $this->hasOne('App\Models\Pacientes','id', 'id_paciente');
    }

    public function Analisi()
    {
        return $this->belongsTo('App\Models\Analisis','id_laboratorio');
    }

    public function personal()
    {
        return $this->hasOne('App\Models\Personal','id', 'origen_usuario');
    }

    public function profesional()
    {
        return $this->hasOne('App\Models\Profesionales','id', 'origen_usuario');
    }
}
