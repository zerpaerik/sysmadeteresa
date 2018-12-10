<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaMateriales extends Model
{
    protected $fillable = [
    	'id_consulta', 'id_material', "cantidad"
    ];
}
