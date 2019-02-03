<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaqueteCont extends Model
{
   
  protected $table = 'paquete_controles';
  protected $fillable = ['paquete_id','cantidad'];
  public $timestamps = false;

  public function selectCantidad($id)
  {

        $array='';
        $cantidadcontroles = \DB::table('paquete_controles')
        ->select('*')
        ->where('paquete_id', $id)
        ->get();
        $descripcion= $cantidadcontroles->cantidad;

        
        
    return substr($descripcion, 0, -1);
  }



  public function paquete()
  {
    return $this->hasOne('App\Models\Paquetes','id','paquete_id');
  }
       
}
