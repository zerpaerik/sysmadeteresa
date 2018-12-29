<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadosMateriales extends Model
{
    protected $fillable = [
    	'id_resultado', 'id_material', "cantidad"
    ];
}
