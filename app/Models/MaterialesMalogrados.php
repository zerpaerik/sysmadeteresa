<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialesMalogrados extends Model
{
	protected $table="mat_malogrados";

    protected $fillable = [
    	'id_producto','cantidad','usuario','id_resultado'
    ];

   
}
