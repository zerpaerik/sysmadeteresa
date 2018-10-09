<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class HistoriaPacientes extends Model
{
    protected $fillable = [
    	'historia'
    ];

      public static function generarHistoria(){
        
      

        $searchContador= DB::table('historia_pacientes')
                    ->select('*')
                    ->get();

        $contador=1;
          if(count($searchContador) ==0){
            $contador=1;
          
            $historia = new HistoriaPacientes;
            $historia->historia=$contador;
            $historia->save();

          
        } else {
         foreach ($searchContador as $correlativo){
            $id=$correlativo->id;
            $contador=$correlativo->historia+1;

         
            $historia=HistoriaPacientes::findOrFail($id);
            $historia->historia=$contador;
            $historia->updated_at=date('Y-m-d H:i:s');
            $historia->update();

        } 
    }

    return str_pad($contador, 4, "0", STR_PAD_LEFT);

    }
   













}