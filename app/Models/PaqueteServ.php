<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class PaqueteServ extends Model
{
  
protected $fillable = [
      'id_paquete', 'id_servicio'
    ];
    
     public function selectAllServicios($id)
    {

        $array='';
        $data = \DB::table('paquetes_servs')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id_paquete', $id)
        ->get();
        $descripcion='';
        
        
        foreach ($data as $key => $value) {

          $dataservicio = \DB::table('servicios')
          ->select('*')
          ->where('id', $value->id_servicio)
          ->get();
          foreach ($dataservicio as $key => $valueservicio) {
            $descripcion.= $valueservicio->detalle.',';
                         
        }
    }

    return substr($descripcion, 0, -1);
}
   
    
}
