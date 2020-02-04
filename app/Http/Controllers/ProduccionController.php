<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consulta;
use App\Http\Requests\CreateConsultaRequest;
use Carbon\Carbon;
use DB;
use App\Models\ConsultaMateriales;
use App\Models\Atenciones;
use App\Models\Personal;
use App\Models\Events\Event;
use App\Models\Existencias\{Producto, Existencia, Transferencia,Historiales};
use Toastr;
use App\Historial;
use App\User;
use App\Treatment;
use Auth;

class ProduccionController extends Controller
{


   public function index(Request $request){

   	if((!is_null($request->fecha)) && (!is_null($request->fecha2)) && (is_null($request->pro))){

          

   		$f1=$request->fecha;
   		$f2=$request->fecha2;


   		 $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.sede','a.paciente','a.time','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('users as c','c.id','a.profesional')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->where('a.sede','=',$request->session()->get('sede'))
        ->orderby('a.id','desc')
        ->get();

        $totalconsultas = Event::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1                         )), date('Y-m-d 23:59:59', strtotime($f2))])
                                ->where('sede','=',$request->session()->get('sede'))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
        $totalc = Event::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date                         ('Y-m-d 23:59:59', strtotime($f2))])
                    ->where('sede','=',$request->session()->get('sede'))
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

 

   	}elseif((!is_null($request->fecha)) && (!is_null($request->fecha2)) && (!is_null($request->pro))){



     


   			$f1=$request->fecha;
   		    $f2=$request->fecha2;

           


         
         $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.atendidopor','a.paciente','a.sede','a.time','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('users as c','c.id','a.profesional')
         ->where('a.sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.atendidopor','=',$request->pro)
        ->orderby('a.id','desc')
        ->get();



        $totalconsultas = Event::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1                         )), date('Y-m-d 23:59:59', strtotime($f2))])
                                    ->where('profesional','=',$request->pro) 
                                     ->where('sede','=',$request->session()->get('sede'))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $totalc = Event::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date                         ('Y-m-d 23:59:59', strtotime($f2))])
                                     ->where('profesional','=',$request->pro) 
                                     ->where('sede','=',$request->session()->get('sede'))
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

       


   	}elseif(!is_null($request->pro) && (is_null($request->fecha))){

   		  $f1 = Carbon::today()->toDateString();
          $f2 = Carbon::today()->toDateString(); 
     
     

         
         $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.atendidopor','a.paciente','a.sede','a.time','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('users as c','c.id','a.profesional')
        ->where('a.atendidopor','=',$request->pro)
        ->where('a.sede','=',$request->session()->get('sede'))
        ->orderby('a.id','desc')
        ->get();

        $totalconsultas = Event::where('profesional','=',$request->pro) 
                                    ->select(DB::raw('SUM(monto) as monto'))
                                             ->where('sede','=',$request->session()->get('sede'))
                                    ->first();

        $totalc = Event::where('profesional','=',$request->pro) 
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                             ->where('sede','=',$request->session()->get('sede'))
                                    ->first();




   	}else{

   		 $f1 = Carbon::today()->toDateString();
          $f2 = Carbon::today()->toDateString(); 


          
         $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.paciente','a.time','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('users as c','c.id','a.profesional')
        ->where('a.profesional','=',0)
        ->orderby('a.id','desc')
        ->get();

        $totalconsultas = Event::select(DB::raw('SUM(monto) as monto'))
                                    ->where('profesional','=',0)
                                    ->first();

        $totalc = Event::select(DB::raw('COUNT(*) as cantidad'))
                                            ->where('profesional','=',0)
                                    ->first();

     
   	}


           // $personal = User::where('tipo','=',1)->get();

    $personal = DB::table('users as a')
    ->select('a.id','a.name','a.lastname','a.tipo')
    ->join('events as b','b.atendidopor','a.id')
    ->groupBy('a.id')
    ->get(); 


       
        return view('produccion.index',["personal" => $personal,"f1" => $f1,"f2" => $f2,"consultas" => $consultas, "totalconsultas" => $totalconsultas,"totalc" => $totalc]);
    }


    /////// para servicios

     public function index2(Request $request){

    if((!is_null($request->fecha)) && (!is_null($request->fecha2)) && (is_null($request->pro))){

          

        $f1=$request->fecha;
        $f2=$request->fecha2;


        
       $sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_sede','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.usuarioinforme','a.fecha_atencion','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','pa.detalle as paquete','s.name as sede')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->join('sedes as s','s.id','a.id_sede')
        ->where('a.id_sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.usuarioinforme','<>','NULL')
        ->whereNotIn('a.monto',[0,0.00])
        //->whereNotIn('a.es_paquete',[1])
       // ->where('a.resultado','=', NULL)
        ->orderby('a.id','desc')
        ->get();

       // dd($sesiones);

          $totalsesiones = Atenciones::whereBetween('fecha_atencion', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                                            ->where('usuarioinforme','<>',NULL)
                                             ->where('id_sede','=',$request->session()->get('sede'))
                                            ->select(DB::raw('SUM(abono) as monto'))
                                            ->first();

                            if ($totalsesiones->monto == 0) {
                        }
          $totals = Atenciones::whereBetween('fecha_atencion', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                           ->where('usuarioinforme','<>',NULL)
                           ->where('id_sede','=',$request->session()->get('sede'))
                           ->select(DB::raw('COUNT(*) as cantidad'))
                           ->first(); 


    }elseif((!is_null($request->fecha)) && (!is_null($request->fecha2)) && (!is_null($request->pro))){



     

            $f1=$request->fecha;
            $f2=$request->fecha2;

           



        $sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_sede','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.usuarioinforme','a.fecha_atencion','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','pa.detalle as paquete','s.name as sede')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->join('sedes as s','s.id','a.id_sede')
        //->join('personals as pr','pr.id','a.atendido')
        ->where('a.id_sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.at','=',$request->pro)
        ->orderby('a.id','desc')
        ->get();

          $totalsesiones = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                                            ->where('at','=',$request->pro)
                                             ->where('id_sede','=',$request->session()->get('sede'))
                                            ->select(DB::raw('SUM(abono) as monto'))
                                            ->first();

                            if ($totalsesiones->monto == 0) {
                        }
          $totals = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',strtotime($f2))])
                           ->where('at','=',$request->pro)
                                ->where('id_sede','=',$request->session()->get('sede'))
                           ->select(DB::raw('COUNT(*) as cantidad'))
                           ->first(); 



    }elseif(!is_null($request->pro) && (is_null($request->fecha))){

          $f1 = Carbon::today()->toDateString();
          $f2 = Carbon::today()->toDateString(); 
     
     

     
       

      
 $sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_sede','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.usuarioinforme','a.fecha_atencion','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','pa.detalle as paquete','s.name as sede')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->join('sedes as s','s.id','a.id_sede')
        ->where('a.at','=',$request->pro)
        ->where('a.id_sede','=',$request->session()->get('sede'))
        ->orderby('a.id','desc')
        ->get();

          $totalsesiones = Atenciones::where('atendido','=',$request->pro)
                              ->where('id_sede','=',$request->session()->get('sede'))
                                            ->select(DB::raw('SUM(abono) as monto'))
                                            ->first();

                            if ($totalsesiones->monto == 0) {
                        }
          $totals = Atenciones::where('atendido','=',$request->pro)
                              ->where('id_sede','=',$request->session()->get('sede'))
                           ->select(DB::raw('COUNT(*) as cantidad'))
                           ->first(); 


    }else{

         $f1 = Carbon::today()->toDateString();
          $f2 = Carbon::today()->toDateString(); 


          
    

       $sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','pa.detalle as paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->where('a.id','=',0)
        ->orderby('a.id','desc')
        ->get();

          $totalsesiones = Atenciones::select(DB::raw('SUM(abono) as monto'))
                                             ->where('atendido','<>',NULL)
                                                     ->where('id','=',0)
                                            ->first();

                            if ($totalsesiones->monto == 0) {
                        }
          $totals = Atenciones::select(DB::raw('COUNT(*) as cantidad'))
                                        ->where('atendido','<>',NULL)
                                        ->where('id','=',0)
                                     ->first(); 


    }



   
           // $personal = User::where('tipo','=',1)->get();


        $personal = DB::table('users as a')
    ->select('a.id','a.name','a.lastname','a.tipo')
    ->join('atenciones as b','b.at','a.id')
    ->orderby('a.id','desc')
    ->groupBy('a.id')
    ->get(); 
     
       
        return view('produccion.index1',["personal" => $personal,"f1" => $f1,"f2" => $f2,"sesiones" => $sesiones, "totalsesiones" => $totalsesiones,"totals" => $totals]);
    }

   
      
}
