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

class HistorialesController extends Controller

{

	public function index(){
      
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $atenciones = $this->elasticSearch($inicio,$final);
      
        return view('reportes.historial.index', ["atenciones" => $atenciones]);
	}

    public function search(Request $request)
    {
    

        $atenciones = $this->elasticSearch($request->inicio,$request->final);
      
        return view('reportes.historial.search', ["atenciones" => $atenciones]); 

 
    }

	
  private function elasticSearch($initial, $final)
  { 
        $atenciones = DB::table('historial as a')
        ->select('a.id','a.accion','a.origen','a.id_usuario','a.created_at','a.detalle','a.sede','b.name','b.lastname')
        ->join('users as b','b.id','a.id_usuario')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($final)), date('Y-m-d 23:59:59', strtotime($final))])
        ->orderby('a.id','desc')
        ->paginate(20);
        return $atenciones;
  }
     
   
}
