<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AplicaMetodo extends Model
{
    protected $fillable = [
    	'id_metodo','peso','talla','usuario','paciente'
    ];

   
}
