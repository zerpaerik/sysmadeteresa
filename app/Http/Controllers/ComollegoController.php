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

         $seleccione = Atenciones::where('comollego', 'Seleccione')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();
      

         $recomendacion = Atenciones::where('comollego', 'Recomendacion')
        
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();
      

         $avisos = Atenciones::where('comollego', 'Avisos')
        
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();
    

          $redes = Atenciones::where('comollego', 'Redes')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();
      

        $otros = Atenciones::where('comollego', 'Otros')
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();
     
       
       
      
        return view('reportes.comollego.index', ["otros" => $otros,"seleccione" => $seleccione,"recomendacion" => $recomendacion,"redes" => $redes, "avisos" => $avisos]);
	}








       
   
}
