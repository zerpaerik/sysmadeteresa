<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use App\Models\Personal;
use App\Models\ResultadosServicios;
use App\Models\ResultadosLaboratorios;
use App\Informe;
use Auth;
use Carbon\Carbon;
use Toastr;



class SesionesController extends Controller

{

	public function index(Request $request){

		if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;  


      	$sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.es_laboratorio','a.fecha_atencion','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','pa.detalle as paquete','a.sesion','a.id_sede')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.atendido','=',NULL)
        ->where('a.resultado','=', NULL)
        ->where('a.sesion','=',1)
        ->orderby('a.id','desc')
        ->get();

    } else {

    		$sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paquete','a.id_paciente','a.origen_usuario','a.atendido','a.es_servicio','a.es_laboratorio','a.fecha_atencion','a.created_at','a.origen','a.id_servicio','a.es_paquete','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','pa.detalle as paquete','a.sesion','a.fecha_atencion','a.id_sede')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('paquetes as pa','pa.id','a.id_paquete')
        ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
                ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.atendido','=',NULL)
        ->where('a.resultado','=', NULL)
        ->where('a.sesion','=',1)
        ->orderby('a.id','desc')
        ->get();

    }
        $informe = Informe::all();
        $personal = Personal::all();

         return view('movimientos.sesiones.index', ['sesiones' => $sesiones, 'personal' => $personal]); 
	}




	public function indexa(Request $request){


      if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


        $sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.atendido','a.fecha_atencion','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.created_at','a.abono','a.pendiente','a.es_servicio','a.es_laboratorio','a.es_paquete','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','p.name as nomper','p.lastname as apeper','a.id_sede')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('personals as p','a.atendido','p.id')
        ->whereBetween('a.fecha_atencion', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.atendido','<>',NULL)
        ->where('a.sesion','=',1)
        ->orderby('a.fecha_atencion','desc')
        ->get();

      } else {

         $sesiones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.atendido','a.fecha_atencion','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.created_at','a.abono','a.pendiente','a.es_servicio','a.es_laboratorio','a.es_paquete','a.resultado','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','p.name as nomper','p.lastname as apeper','a.id_sede')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('personals as p','a.atendido','p.id')
        ->whereDate('a.fecha_atencion', '=',Carbon::today()->toDateString())
                ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.atendido','<>',NULL)
        ->where('a.sesion','=',1)
        ->orderby('a.fecha_atencion','desc')
        ->get();

      }

       return view('movimientos.sesiones.indexa', ['sesiones' => $sesiones]); 
	}






   public function atender(Request $request){

     
      $p = Atenciones::find($request->id);
      $p->atendido = $request->atendido;
      $p->fecha_atencion = Carbon::today()->toDateString();
      $res = $p->save();

      Toastr::success('Atendido Exitosamente.', 'Paciente!', ['progressBar' => true]);
      return back();
    }

    


    }


