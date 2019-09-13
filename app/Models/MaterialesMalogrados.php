<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialesMalogrados extends Model
{
	protected $table="mat_malogrados";

    protected $fillable = [
    	'id_producto','cantidad','usuario','id_resultado','id_atencion','sede'
    ];


      public function productos()
    {
    	return $this->hasOne('App\Models\Existencias\Producto','id', 'id_producto');
    }

    
   
}
