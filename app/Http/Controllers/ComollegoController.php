<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use Auth;
use Toastr;

class ComollegoController extends Controller

{

		public function index(){
       
        return view('reportes.comollego.index');
	}
	
	public function search(){

        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $seleccione = $this->elasticSearch1($inicio,$final);
	    $recomendacion = $this->elasticSearch2($inicio,$final);
        $avisos = $this->elasticSearch3($inicio,$final);
        $redes = $this->elasticSearch4($inicio,$final);
        $otros = $this->elasticSearch5($inicio,$final);

        return view('reportes.comollego.search', ["otros" => $otros,"seleccione" => $seleccione,"recomendacion" => $recomendacion,"redes" => $redes, "avisos" => $avisos]);
	}
	
	private function elasticSearch1($initial, $final)
  { 
      $seleccione = Atenciones::where('comollego', 'Seleccione')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
									->whereNotIn('monto',[0,0.00])
									->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $seleccione;
  }
  
  private function elasticSearch2($initial, $final)
  { 
      $recomendacion = Atenciones::where('comollego', 'Recomendacion')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
									->whereNotIn('monto',[0,0.00])
									->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $recomendacion;
  }
  
   private function elasticSearch3($initial, $final)
  { 
      $avisos = Atenciones::where('comollego', 'Avisos')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
									->whereNotIn('monto',[0,0.00])
									->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $avisos;
  }
  
   private function elasticSearch4($initial, $final)
  { 
      $redes = Atenciones::where('comollego', 'Redes')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
									->whereNotIn('monto',[0,0.00])
									->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $redes;
  }
	
	 private function elasticSearch5($initial, $final)
  { 
      $otros = Atenciones::where('comollego', 'Otros')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
									->whereNotIn('monto',[0,0.00])
									->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
                                    ->first();

        return $otros;
  }
	
	
	









       
   
}
