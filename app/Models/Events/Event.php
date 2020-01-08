<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $fillable = ['title','date', 'time','profesional', 'paciente', 'monto','sede','atendido','tipo','paquete','usuario','es_delete','tipopago','llamado','prox','eliminado_por'];

}
