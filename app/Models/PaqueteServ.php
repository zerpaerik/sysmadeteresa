<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaqueteServ extends Model
{
    protected $table = 'paquete_servicios';
    protected $fillable = ['paquete_id', 'servicio_id'];
    public $timestamps = false;
    
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

    public function servicio()
    {
      return $this->hasOne('App\Models\Servicios','id','servicio_id');
    }

    public function paquete()
    {
      return $this->hasOne('App\Models\Paquetes','id','paquete_id');
    }
}
