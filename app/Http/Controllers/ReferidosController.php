<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Servicios;
use App\Models\Atenciones;
use App\Models\Analisis;
use App\Models\Pacientes;
use App\Models\ReferidoServicios;
use App\Models\ReferidoLabs;
use App\Models\Creditos;
use App\Http\Controllers\AtencionesController;
use Auth;
use Carbon\Carbon;
use Toastr;



class ReferidosController extends Controller

{

	public function index(Request $request){

		
        if((!is_null($request->pro))){

      	$serv = DB::table('referido_servicios as a')
        ->select('a.id','a.paciente','a.servicio','a.estatus','a.usuario','a.created_at as fecha','a.es_s as se','a.es_l as la','b.nombres', 'b.apellidos','b.telefono', 'c.detalle as item','c.id as itd', 'e.name as usuario', 'e.lastname as usuariop')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('servicios as c','c.id','a.servicio')
        ->join('users as e','e.id','a.usuario')
        ->where('a.usuario','=',$request->pro);


        
      	$referidos = DB::table('referido_labs as a')
          ->select('a.id','a.paciente','a.lab','a.estatus','a.usuario','a.created_at as fecha','a.es_s as se','a.es_l as la','b.nombres', 'b.apellidos','b.telefono', 'c.name as item','c.id as itd', 'e.name as usuario', 'e.lastname as usuariop')
          ->join('pacientes as b','b.id','a.paciente')
          ->join('analises as c','c.id','a.lab')
          ->join('users as e','e.id','a.usuario')
          ->where('a.usuario','=',$request->pro)
          ->union($serv)
          ->orderby('fecha','desc')
          ->get();

       } else {

        $serv = DB::table('referido_servicios as a')
        ->select('a.id','a.paciente','a.servicio','a.estatus','a.usuario','a.created_at as fecha','a.es_s as se','a.es_l as la','b.nombres', 'b.apellidos','b.telefono', 'c.detalle as item','c.id as itd', 'e.name as usuario', 'e.lastname as usuariop')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('servicios as c','c.id','a.servicio')
        ->join('users as e','e.id','a.usuario')
        ->where('a.created_at','=',date('Y-m-d'));


        
      	$referidos = DB::table('referido_labs as a')
          ->select('a.id','a.paciente','a.lab','a.estatus','a.usuario','a.created_at as fecha','a.es_s as se','a.es_l as la','b.nombres', 'b.apellidos','b.telefono', 'c.name as item','c.id as itd', 'e.name as usuario', 'e.lastname as usuariop')
          ->join('pacientes as b','b.id','a.paciente')
          ->join('analises as c','c.id','a.lab')
          ->join('users as e','e.id','a.usuario')
          ->where('a.created_at','=',date('Y-m-d'))
          ->union($serv)
          ->orderby('fecha','desc')
          ->get();


       }

        //$referidos = $serv->merge($lab);

        $profesionales = DB::table('users as a')
        ->select('a.id','a.name','a.lastname')
        ->join('referido_servicios as b','b.usuario','a.id')
        ->groupBy('a.id')
        ->get(); 

         return view('referidos.index', compact('referidos', 'profesionales')); 
  }
  
  public function show($id, $id2, $id3)
    {

      if($id2 == 1){

        $data = DB::table('referido_servicios as a')
        ->select('a.id','a.paciente','a.servicio','a.estatus','a.usuario as prof','a.created_at','a.es_s as se','a.es_l as la','b.nombres', 'b.apellidos','b.id as pac', 'c.detalle as item','c.id as itd','c.porcentaje','c.precio as precio', 'e.name as usuario', 'e.lastname as usuariop')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('servicios as c','c.id','a.servicio')
        ->join('users as e','e.id','a.usuario')
        ->where('a.id','=',$id)
        ->first();

      } else {

        $data = DB::table('referido_labs as a')
        ->select('a.id','a.paciente','a.lab','a.estatus','a.usuario as prof','a.created_at','a.es_s as se','a.es_l as la','b.nombres', 'b.apellidos','b.id as pac', 'c.name as item','c.id as itd','c.porcentaje','c.preciopublico as precio',  'e.name as usuario', 'e.lastname as usuariop')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('analises as c','c.id','a.lab')
        ->join('users as e','e.id','a.usuario')
        ->where('a.id','=',$id)
        ->first();

      }

	  
      return view('referidos.show', compact('id','id2','id3','data'));
    }	 


    public function create(Request $request){

     // dd($request->all());

      if($request->se == 1){

        $serv= Servicios::where('id',$request->item)->first();


      $l = new Atenciones();
      $l->id_paciente = $request->paciente;
      $l->origen = 2;
      $l->origen_usuario = $request->prof;
      $l->id_laboratorio = 1;
      $l->id_servicio = $request->item;
      $l->id_paquete = 1;
      $l->comollego = 'APP';
      $l->es_paquete =  0;
      $l->es_servicio =  1;
      $l->es_laboratorio = 0;
      $l->serv_prog = FALSE;
      $l->tipopago = $request->tipopago;
      $l->porc_pagar = $serv->porcentaje;
      $l->pendiente = $request->monto - $request->abono;
      $l->monto = $request->monto;
      $l->abono = $request->abono;
      $l->porcentaje =$request->monto * $serv->porcentaje / 100;
      $l->id_sede =$request->session()->get('sede');
      $l->estatus = 1;
      $l->particular = '';
      $l->usuario = Auth::user()->id;
      $l->ticket =AtencionesController::generarId($request);
      $l->paquete= null; 
      $l->save(); 

      $p = ReferidoServicios::where('id','=',$request->referido)->first();
      $p->estatus = 2;
      $res = $p->save();

          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $l->id;
          $creditos->monto= $request->abono;
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = $request->tipopago;
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->date = date('Y-m-d');
          if($request->tipopago=='EF'){
          $creditos->efectivo = $request->abono;
          }else{
          $creditos->tarjeta = $request->abono;
          }
          $creditos->save();

    } else {

      $ana= Analisis::where('id',$request->item)->first();


      $l = new Atenciones();
      $l->id_paciente = $request->paciente;
      $l->origen = 2;
      $l->origen_usuario = $request->prof;
      $l->id_laboratorio = $request->item;
      $l->id_servicio = 1;
      $l->id_paquete = 1;
      $l->comollego = 'APP';
      $l->es_paquete =  0;
      $l->es_servicio =  0;
      $l->es_laboratorio = 1;
      $l->serv_prog = FALSE;
      $l->tipopago = $request->tipopago;
      $l->porc_pagar = $ana->porcentaje;
      $l->pendiente = $request->monto - $request->abono;
      $l->monto = $request->monto;
      $l->abono = $request->abono;
      $l->porcentaje =$request->monto * $ana->porcentaje / 100;
      $l->id_sede =$request->session()->get('sede');
      $l->estatus = 1;
      $l->particular = '';
      $l->usuario = Auth::user()->id;
      $l->ticket =AtencionesController::generarId($request);
      $l->paquete= null; 
      $l->save(); 

      $p = ReferidoLabs::where('id','=',$request->referido)->first();
      $p->estatus = 2;
      $res = $p->save();

      $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $l->id;
          $creditos->monto= $request->abono;
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = $request->tipopago;
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->date = date('Y-m-d');
          if($request->tipopago=='EF'){
          $creditos->efectivo = $request->abono;
          }else{
          $creditos->tarjeta = $request->abono;
          }
          $creditos->save();


    }
     
      Toastr::success('Registrado Exitosamente.', 'Ingreso!', ['progressBar' => true]);
      return back();
  } 







    }
