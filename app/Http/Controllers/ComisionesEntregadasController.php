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

class ComisionesEntregadasController extends Controller

{

	public function index(){
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $atenciones = $this->elasticSearch($inicio,$final);
        return view('movimientos.comentregadas.index', ["atenciones" => $atenciones]);
	}

    public function search(Request $request)
    {
        $atenciones = $this->elasticSearch($request->inicio,$request->final);
        return view('movimientos.comentregadas.search', ["atenciones" => $atenciones]); 
    }


  private function elasticSearch($initial, $final)
  { 
        $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.id_sede','a.es_servicio','a.usuario_entrega','a.updated_at','a.es_laboratorio','entregado','a.recibo','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.name as nomentre','f.lastname as apeentre')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as f','f.id','a.usuario_entrega')
        ->where('a.entregado','=', 1)
        ->where('a.id_sede','=', \Session::get("sede"))
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
        //->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($final)), date('Y-m-d 23:59:59', strtotime($final))])
        ->groupBy('a.recibo')
        ->orderby('a.id','desc')
        ->get();



        return $atenciones;
  }

  


  
       
   
}
