<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;

class RangoConsulta extends Model
{
    public $table = 'rangoconsultas';
    protected $fillable = ['start_time', 'end_time'];
}
