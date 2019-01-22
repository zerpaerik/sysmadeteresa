<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debitos extends Model
{
    protected $fillable = [
    	'id_gasto', 'origen', "descripcion",'monto','id_sede','nombre','usuario'
    ];
}
