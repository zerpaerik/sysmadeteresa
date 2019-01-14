<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Historiales;
use Auth;
use Toastr;

class HistorialCobrosController extends Controller

{

	public function index(Request $request){



      if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    
        


        $atenciones = DB::table('historialcobros as a')
        ->select('a.id','a.id_atencion','a.id_paciente','a.monto','a.abono_parcial','a.abono','a.pendiente','b.nombres','b.apellidos','b.dni','a.created_at','a.updated_at')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','ASC')
        ->get();

      } else {

        
        $atenciones = DB::table('historialcobros as a')
        ->select('a.id','a.id_atencion','a.id_paciente','a.monto','a.abono_parcial','a.abono','a.pendiente','b.nombres','b.apellidos','b.dni','a.created_at','a.updated_at')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
        ->orderby('a.id','ASC')
        ->get();

      }
       
        return view('movimientos.historialcobros.index', ["atenciones" => $atenciones]);
	}

   
	

  private function elasticSearch($initial,$final,$nom,$ape)
  { 
        $atenciones = DB::table('historialcobros as a')
        ->select('a.id','a.id_atencion','a.id_paciente','a.monto','a.abono_parcial','a.abono','a.pendiente','b.nombres','b.apellidos','a.created_at','a.updated_at')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->where('b.nombres','like','%'.$nom.'%')
        ->where('b.apellidos','like','%'.$ape.'%')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($final)), date('Y-m-d 23:59:59', strtotime($final))])
        ->orderby('a.id','desc')
        ->paginate(20);
        return $atenciones;
  }




  
       
   
}
