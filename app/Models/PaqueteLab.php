<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaqueteLab extends Model
{
   
  protected $table = 'paquete_laboratorios';
  protected $fillable = ['paquete_id','laboratorio_id'];
  public $timestamps = false;

  public function selectAllAnalisis($id)
  {

        $array='';
        $data = \DB::table('paquete_laboratorios')
        ->select('*')
        ->where('paquete_id', $id)
        ->get();
        $descripcion='';

        
        foreach ($data as $key => $value) {

          $dataanalises = \DB::table('analises')
          ->select('*')
          ->where('id', $value->laboratorio_id)
          ->get();
          foreach ($dataanalises as $key_analises => $valueservicioanalises) {
            $descripcion.= $valueservicioanalises->name.',';
                          # code...
          }
        }
    return substr($descripcion, 0, -1);
  }

  public function laboratorio()
  {
    return $this->hasOne('App\Models\Analisis','id','laboratorio_id');
  }

  public function paquete()
  {
    return $this->hasOne('App\Models\Paquetes','id','paquete_id');
  }
       
}
