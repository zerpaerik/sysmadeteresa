<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialesConsultas extends Model
{
	protected $table="materiales_consultas";

    protected $fillable = [
    	'id_producto','id_consulta','cantidad','usuario','sede'
    ];


    
   
}
