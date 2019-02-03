<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaqueteCons extends Model
{
   
  protected $table = 'paquete_consultas';
  protected $fillable = ['paquete_id','cantidad'];
  public $timestamps = false;

  public function selectCantidad($id)
  {

        $array='';
        $cantidadconsultas = \DB::table('paquete_consultas')
        ->select('*')
        ->where('paquete_id', $id)
        ->get();
        $descripcion= $cantidadconsultas->cantidad;

        
        
    return substr($descripcion, 0, -1);
  }



  public function paquete()
  {
    return $this->hasOne('App\Models\Paquetes','id','paquete_id');
  }
       
}
