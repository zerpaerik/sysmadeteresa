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
use App\Models\Servicios;
use App\Models\Paquetes;
use Auth;
use Toastr;

class ReporteIngresosController extends Controller
{
	
	public function indexa(Request $request){

    if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


       $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
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
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
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
        ->select('a.id','a.descripcion','a.monto','a.origen','a.created_at','a.nombre','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','desc')
        ->get();

          $aten = Debitos::where('id_sede','=', $request->session()->get('sede'))
                        ->whereNotIn('monto',[0,0.00])
                        ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($aten->monto == 0) {
        }

      } else {


        $atenciones = DB::table('debitos as a')
        ->select('a.id','a.descripcion','a.monto','a.origen','a.created_at','a.nombre','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
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

  public function generals(Request $request){

    if(! is_null($request->fecha) && ! is_null($request->servicio)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


       $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','a.paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
          ->where('a.es_servicio','=',1)
          ->where('a.paquete','=',NULL)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.id_servicio','=',$request->servicio)
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','desc')
        ->get();
 

        
         $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->where('id_servicio','=',$request->servicio)
                                        ->where('es_servicio','=',1)
                                                  ->where('paquete','=',NULL)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->where('id_servicio','=',$request->servicio)
                          ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->where('id_servicio','=',$request->servicio)
                          ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }




      } elseif(!is_null($request->fecha) && is_null($request->servicio)) {

        $f1 = $request->fecha;
        $f2 = $request->fecha2;   

         
       $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','a.paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
          ->where('a.es_servicio','=',1)
          ->where('a.paquete','=',NULL)
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])->orderby('a.id','desc')
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00])
        ->get();


          $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->whereNotIn('monto',[0,0.00])
                          ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->whereNotIn('monto',[0,0.00])
                          ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->whereNotIn('monto',[0,0.00])
                          ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }


      }elseif(!is_null($request->servicio) && is_null($request->fecha)){

          $f1 = Carbon::today()->toDateString();
        $f2 = Carbon::today()->toDateString();

         
       $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','a.paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
          ->where('a.es_servicio','=',1)
          ->where('a.paquete','=',NULL)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.id_servicio','=',$request->servicio)
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();
 

         $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->where('id_servicio','=',$request->servicio)
                       ->whereNotIn('monto',[0,0.00])
                          ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->where('id_servicio','=',$request->servicio)
                       ->whereNotIn('monto',[0,0.00])
                         ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->where('id_servicio','=',$request->servicio)
                       ->whereNotIn('monto',[0,0.00])
                           ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }

      }else{

         $f1 = Carbon::today()->toDateString();
        $f2 = Carbon::today()->toDateString();

          
       $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','a.paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
          ->where('a.es_servicio','=',1)
          ->where('a.paquete','=',NULL)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();
 

         $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                  ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                               ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->whereNotIn('monto',[0,0.00])
                         ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                                ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->whereNotIn('monto',[0,0.00])
                         ->where('es_servicio','=',1)
                          ->where('paquete','=',NULL)
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }

      }

      $servicios = Servicios::where('estatus','=',1)->orderby('detalle','ASC')->get();


      return view('reportes.general_atenciones_servicios', ["atenciones" => $atenciones,"monto" => $monto,"servicios" => $servicios,"f1" => $f1, "f2" => $f2, "abono" => $abono, "comision" => $comision]);
  }


  public function generall(Request $request){

    if(! is_null($request->fecha) && ! is_null($request->lab)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


       $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.name as laboratorio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_laboratorio','=',1)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.id_laboratorio','=',$request->lab)
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','desc')
        ->get();
 

        
         $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_laboratorio','=',1)
                       ->where('id_laboratorio','=',$request->lab)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                ->where('es_laboratorio','=',1)
                       ->where('id_laboratorio','=',$request->lab)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_laboratorio','=',1)
                       ->where('id_laboratorio','=',$request->lab)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }




      } elseif(!is_null($request->fecha) && is_null($request->lab)) {

        $f1 = $request->fecha;
        $f2 = $request->fecha2;   

           $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.name as laboratorio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
                ->where('a.es_laboratorio','=',1)
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])->orderby('a.id','desc')
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00])
        ->get();


          $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->whereNotIn('monto',[0,0.00])
                               ->where('es_laboratorio','=',1)
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->whereNotIn('monto',[0,0.00])
                               ->where('es_laboratorio','=',1)
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_laboratorio','=',1)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }


      }elseif(!is_null($request->lab) && is_null($request->fecha)){

          $f1 = Carbon::today()->toDateString();
        $f2 = Carbon::today()->toDateString();

          $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.name as laboratorio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
                ->where('a.es_laboratorio','=',1)
        ->where('a.id_laboratorio','=',$request->lab)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.id_servicio','=',$request->servicio)
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();
 

         $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_laboratorio','=',1)
                        ->where('id_laboratorio','=',$request->lab)
                       ->whereNotIn('monto',[0,0.00])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                ->where('es_laboratorio','=',1)
                       ->where('id_laboratorio','=',$request->lab)
                       ->whereNotIn('monto',[0,0.00])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_laboratorio','=',1)
                       ->where('id_laboratorio','=',$request->lab)
                       ->whereNotIn('monto',[0,0.00])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }

      }else{

         $f1 = Carbon::today()->toDateString();
        $f2 = Carbon::today()->toDateString();

         $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.name as laboratorio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
                ->where('a.es_laboratorio','=',1)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();
 

         $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_laboratorio','=',1)
                       ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                ->where('es_laboratorio','=',1)
                               ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_laboratorio','=',1)
                                ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }

      }

      $laboratorios = Analisis::where('estatus','=',1)->orderby('name','ASC')->get();


      return view('reportes.general_atenciones_labs', ["atenciones" => $atenciones,"monto" => $monto,"laboratorios" => $laboratorios,"f1" => $f1, "f2" => $f2, "abono" => $abono, "comision" => $comision]);

  }

  public function generalp(Request $request){


       if(! is_null($request->fecha) && ! is_null($request->paq)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


       $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as paquete','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_paquete','=',1)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.id_paquete','=',$request->paq)
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','desc')
        ->get();
 

        
         $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                  ->where('es_paquete','=',1)
                       ->where('id_paquete','=',$request->paq)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_paquete','=',1)
                       ->where('id_paquete','=',$request->paq)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_paquete','=',1)
                       ->where('id_paquete','=',$request->paq)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }




      } elseif(!is_null($request->fecha) && is_null($request->paq)) {

        $f1 = $request->fecha;
        $f2 = $request->fecha2;   

           $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as paquete','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_paquete','=',1)
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])->orderby('a.id','desc')
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00])
        ->get();


          $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->whereNotIn('monto',[0,0.00])
                 ->where('es_paquete','=',1)
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                       ->whereNotIn('monto',[0,0.00])
                 ->where('es_paquete','=',1)
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_paquete','=',1)
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }


      }elseif(!is_null($request->paq) && is_null($request->fecha)){

          $f1 = Carbon::today()->toDateString();
        $f2 = Carbon::today()->toDateString();

          $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as paquete','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_paquete','=',1)
        ->where('a.id_paquete','=',$request->paq)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();
 

         $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_paquete','=',1)
                       ->where('id_paquete','=',$request->paq)
                       ->whereNotIn('monto',[0,0.00])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                ->where('es_paquete','=',1)
                       ->where('id_paquete','=',$request->paq)
                       ->whereNotIn('monto',[0,0.00])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_paquete','=',1)
                       ->where('id_paquete','=',$request->paq)
                       ->whereNotIn('monto',[0,0.00])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }

      }else{

         $f1 = Carbon::today()->toDateString();
        $f2 = Carbon::today()->toDateString();

         $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.usuarioinforme','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.id_sede','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as paquete','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_paquete','=',1)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();
 

         $monto = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_paquete','=',1)
                       ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
        if ($monto->monto == 0) {
        }

        $abono = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_paquete','=',1)
                               ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(abono) as monto'))
                       ->first();
        if ($abono->monto == 0) {
        }

         $comision = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                 ->where('es_paquete','=',1)
                                ->whereDate('created_at', '=',Carbon::today()->toDateString())
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(porcentaje) as monto'))
                       ->first();
        if ($comision->monto == 0) {
        }

      }

      $paquetes = Paquetes::where('estatus','=',1)->orderby('detalle','ASC')->get();


      return view('reportes.general_atenciones_paqs', ["atenciones" => $atenciones,"monto" => $monto,"paquetes" => $paquetes,"f1" => $f1, "f2" => $f2, "abono" => $abono, "comision" => $comision]);




      return view('reportes.general_atenciones_paqs', ["atenciones" => $atenciones,"monto" => $monto,"paquetes" => $paquetes,"f1" => $f1, "f2" => $f2, "abono" => $abono, "comision" => $comision]);

  }

    

 
}