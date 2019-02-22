<?php
namespace App\Http\Controllers;
/**
 * 
 */
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use Auth;
use Toastr;

class ReporteIngresosController extends Controller
{
	
	public function indexa(Request $request){

    if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


       $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','c.por_tec','e.name','e.lastname','d.name as laboratorio')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','desc')
        ->paginate(20000000);


         $aten = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($aten->monto == 0) {
        }




      } else {

          $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','c.por_tec','e.name','e.lastname','d.name as laboratorio')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00])
        ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
        ->orderby('a.id','desc')
        ->paginate(20000000);


         $aten = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->whereNotIn('monto',[0,0.00])
                        ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($aten->monto == 0) {
        }


      }






       

        return view('reportes.general_atenciones.index', ["atenciones" => $atenciones,"aten" => $aten]);
	}

    



    public function indexe(Request $request){

       if(! is_null($request->fecha)) {

          $f1 = $request->fecha;
          $f2 = $request->fecha2;    



        $atenciones = DB::table('debitos as a')
        ->select('a.id','a.descripcion','a.monto','a.origen','a.created_at')
        ->where('id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','desc')
        ->paginate(200000000);

          $aten = Debitos::where('id_sede','=', $request->session()->get('sede'))
                        ->whereNotIn('monto',[0,0.00])
                        ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($aten->monto == 0) {
        }

      } else {


        $atenciones = DB::table('debitos as a')
        ->select('a.id','a.descripcion','a.monto','a.origen','a.created_at')
        ->where('id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00])
        ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
        ->orderby('a.id','desc')
        ->paginate(200000000);


          $aten = Debitos::where('id_sede','=', $request->session()->get('sede'))
                        ->whereNotIn('monto',[0,0.00])
                        ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($aten->monto == 0) {
        }



      }
        
        return view('reportes.general_egresos.index', ["atenciones" => $atenciones, "aten" => $aten]);
  }

    

 
}