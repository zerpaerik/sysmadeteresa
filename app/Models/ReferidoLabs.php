<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferidoLabs extends Model
{
    protected $table = 'referido_labs';
    protected $fillable = ['paciente', 'lab', 'usuario', 'estatus','es_s','es_l'];
    
}