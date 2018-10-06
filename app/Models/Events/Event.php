<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $fillable = ['title','start_date','end_date', 'profesional', 'paciente', 'entrada', 'monto'];

}
