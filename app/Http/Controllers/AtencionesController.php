<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Servicios;
use App\Models\Analisis;
use App\Models\Pacientes;
use App\Models\Personal;
use App\Models\Profesionales;
use App\Models\Creditos;
use App\Models\Paquetes;
use App\Models\Correlativo;
use App\Models\Existencias\Producto;
use App\Models\ServicioMaterial;
use App\User;
use Auth;
use Carbon\Carbon;
use Toastr;
use App\Models\Events\{Event, RangoConsulta};


class AtencionesController extends Controller

{

	public function index(Request $request){
    $initial = Carbon::now()->toDateString();
    $atenciones = $this->elasticSearch($initial,'','',$request);
    return view('movimientos.atenciones.index', [
      "icon" => "fa-list-alt",
      "model" => "atenciones",
      "model1" => "ticket",
      "headers" => ["Nombre Paciente", "Apellido Paciente","Nombre Origen","Apellido Origen","Servicio","Laboratorio","Paquete","Monto","Monto Abonado","Fecha","Editar", "Eliminar"],
      "data" => $atenciones,
      "fields" => ["nombres", "apellidos","name","lastname","servicio","laboratorio","paquete","monto","abono","created_at"],
      "actions" => [
        '<button type="button" class="btn btn-info">Transferir</button>',
        '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]); 

  }

    public function search(Request $request){

    $search = $request->nom;
    $split = explode(" ",$search);

    if (!isset($split[1])) {
     
      $split[1] = '';
      $atenciones = $this->elasticSearch($request->inicio,$split[0],$split[1],$request);
      
      return view('movimientos.atenciones.search', [
      "icon" => "fa-list-alt",
      "model" => "atenciones",
      "model1" => "ticket",
      "headers" => ["Nombre Paciente", "Apellido Paciente","Nombre Origen","Apellido Origen","Servicio","Laboratorio","Paquete","Monto","Monto Abonado","Fecha","Editar", "Eliminar"],
      "data" => $atenciones,
      "fields" => ["nombres", "apellidos","name","lastname","servicio","laboratorio","paquete","monto","abono","created_at"],
        "actions" => [
          '<button type="button" class="btn btn-info">Transferir</button>',
          '<button type="button" class="btn btn-warning">Editar</button>'
        ]
    ]); 
    }else{
      $atenciones = $this->elasticSearch($request->inicio,$split[0],$split[1],$request);  

      return view('movimientos.atenciones.search', [
      "icon" => "fa-list-alt",
      "model" => "atenciones",
      "headers" => ["Nombre Paciente", "Apellido Paciente","Nombre Origen","Apellido Origen","Servicio","Laboratorio","Paquete","Monto","Monto Abonado","Fecha","Editar", "Eliminar"],
      "data" => $atenciones,
      "fields" => ["nombres", "apellidos","name","lastname","servicio","laboratorio","paquete","monto","abono","created_at"],
        "actions" => [
          '<button type="button" class="btn btn-info">Transferir</button>',
          '<button type="button" class="btn btn-warning">Editar</button>'
        ]
    ]);         
    }      
  }


   

	public function createView() {

    //$servicios = Servicios::all();
    //$laboratorios = Analisis::all();
    //$pacientes = Pacientes::all();
    //$paquetes = Paquetes::all();
    $servicios =Servicios::where("estatus", '=', 1)->whereNotIn('id',[1])->orderby('detalle','asc')->get();
    $laboratorios =Analisis::where("estatus", '=', 1)->whereNotIn('id',[1])->orderby('name','asc')->get();
    $pacientes =Pacientes::where("estatus", '=', 1)->orderby('nombres','asc')->get();
    $paquetes =Paquetes::where("estatus", '=', 1)->whereNotIn('id',[1])->get();


    
    return view('movimientos.atenciones.create', compact('servicios','laboratorios','pacientes','paquetes'));
  }



  public static function generarId(Request $request){
  
        $searchContador= DB::table('correlativos')
                    ->select('*')
                    ->where('sede','=', $request->session()->get('sede'))
                    ->get();

        $numero=1;
          if(count($searchContador) ==0){
            $numero=1;
          
            $correlativo = new Correlativo;
            $correlativo->numero=$numero;
            $correlativo->sede=$request->session()->get('sede');
            $correlativo->save();

          
        } else {
         foreach ($searchContador as $correlativo){
            $numero=$correlativo->numero+1;

         
            $correlativo=Correlativo::findOrFail($correlativo->id);
            $correlativo->numero=$numero;
            $correlativo->updated_at=date('Y-m-d');
            $correlativo->update();

        } 
    }


    return str_pad($numero, 6, "0", STR_PAD_LEFT);

    }

  public function create(Request $request)
  {
    if(is_null($request->origen_usuario) && ($request->origen <> 3)){
      Toastr::error('Debe Seleccionar un Origen', 'Ingreso de Atenciòn!', ['progressBar' => true]);

    return back();
  }



	
   if($request->origen == 3){
	   
	   if (is_null($request->id_servicio['servicios'][0]['servicio']) && is_null($request->id_laboratorio['laboratorios'][0]['laboratorio'])){
      return redirect()->route('atenciones.create');
    }

    if (isset($request->id_paquete)) {
      
      foreach ($request->id_paquete['paquetes'] as $key => $paquete) {
        if (!is_null($paquete['paquete'])) {
              $paquete = Paquetes::findOrFail($paquete['paquete']);
              $paq = new Atenciones();
              $paq->id_paciente = $request->id_paciente;
              $paq->origen = $request->origen;
              $paq->origen_usuario = 99999999;
              $paq->id_laboratorio =  1;
              $paq->id_servicio =  1;
              $paq->id_paquete = $paquete->id;
              $paq->comollego = $request->comollego;
              $paq->es_paquete =  true;
			  $paq->serv_prog = FALSE;
              $paq->tipopago = $request->tipopago;
              $paq->porc_pagar = $paquete->porcentaje;
              $paq->pendiente = (float)$request->monto_p['paquetes'][$key]['monto'] - (float)$request->monto_abop['paquetes'][$key]['abono'];
              $paq->monto = (float)$request->monto_p['paquetes'][$key]['monto'];
              $paq->abono = (float)$request->monto_abop['paquetes'][$key]['abono'];
              $paq->porcentaje = ((float)$request->monto_p['paquetes'][$key]['monto']* $paquete->porcentaje)/100;
              $paq->id_sede =$request->session()->get('sede');
              $paq->estatus = 1;
              $paq->usuario = Auth::user()->id;
              $paq->particular = $request->particular;
                            $paq->ticket =AtencionesController::generarId($request);
              $paq->save(); 

              $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $paq->id;
              $creditos->monto= $request->monto_abop['paquetes'][$key]['abono'];
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();


        } else {

        }
      }
	  
	         
	////////// guardar servicios y analisis que conforman el paquete
	 if(! is_null($request->id_paquete)){
     foreach ($request->id_paquete as $key => $value) {

        $searchServPaq = DB::table('paquete_servicios')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('paquete_id','=', $value)
        ->get();
		
		

        foreach ($searchServPaq as $serv) {
            $id_servicio = $serv->servicio_id;
			
			$servdetalle =  DB::table('servicios')
			->select('*')
			->where('id','=',$id_servicio)
			->first();
			
			$detalle = $servdetalle->detalle;
      $sesion = $servdetalle->sesion;

            if(! is_null($id_servicio)){
              $s = new Atenciones();
              $s->id_paciente = $request->id_paciente;
              $s->origen = $request->origen;
              $s->origen_usuario = 99999999;
              $s->id_laboratorio =  1;
              $s->id_servicio =  $id_servicio;
              $s->id_paquete = 1;
              $s->comollego = $request->comollego;
              $s->es_paquete =  0;
			  $s->es_servicio =  1;
              $s->es_laboratorio =  0;
			  $s->serv_prog = FALSE;
              $s->tipopago = $request->tipopago;
              $s->porc_pagar = 0;
              $s->pendiente = 0;
              $s->monto = 99999;
              $s->abono = 0;
              $s->porcentaje =0;
              $s->sesion =$sesion;
              $s->id_sede =$request->session()->get('sede');
              $s->estatus = 1;
              $s->particular = $request->particular;
              $s->usuario = Auth::user()->id;
                            $s->ticket =AtencionesController::generarId($request);
              $s->save(); 
             
         }
        }

        $searchLabPaq = DB::table('paquete_laboratorios')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();

         foreach ($searchLabPaq as $lab) {
            $id_laboratorio = $lab->laboratorio_id;


            if(!is_null($id_laboratorio)){
			  $l = new Atenciones();
              $l->id_paciente = $request->id_paciente;
              $l->origen = $request->origen;
              $l->origen_usuario = 99999999;
              $l->id_laboratorio = $id_laboratorio;
              $l->id_servicio = 1;
              $l->id_paquete = 1;
              $l->comollego = $request->comollego;
              $l->es_paquete =  0;
			  $l->es_servicio =  0;
              $l->es_laboratorio = 1;
			  $l->serv_prog = FALSE;
              $l->tipopago = $request->tipopago;
              $l->porc_pagar = 0;
              $l->pendiente = 0;
              $l->monto = 99999;
              $l->abono = 0;
              $l->porcentaje =0;
              $l->id_sede =$request->session()->get('sede');
              $l->estatus = 1;
              $l->particular = $request->particular;
                            $l->usuario = Auth::user()->id;
                                          $l->ticket =AtencionesController::generarId($request);
              $l->save(); 

         }
        }

         
        $paciente = DB::table('pacientes')
        ->select('*')
        ->where('id','=', $request->id_paciente)
        ->first();
          
         $searchConsPaq = DB::table('paquete_consultas')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();

                if(count($searchConsPaq) > 0){


          foreach ($searchConsPaq as $cons) {
            $cantidad=$cons->cantidad;
             }



         $contador=0;
         
        while ($contador < $cantidad) {
        
        $evt = new Event;
        $evt->paciente=$request->id_paciente;
        $evt->profesional=36;
        $evt->date=date('Y-m-d');
        $evt->time=17;
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=0;
        $evt->sede=$request->session()->get('sede');
        $evt->tipo='CONSULTAS';
        $evt->save();

           $contador++;
         } 

       }


           $searchContPaq = DB::table('paquete_controles')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();


        $paciente = DB::table('pacientes')
        ->select('*')
        ->where('id','=', $request->id_paciente)
        ->first();

                if(count($searchContPaq) > 0){


          foreach ($searchContPaq as $cons) {
            $cantidad=$cons->cantidad;
             }



         $contador=0;
         
        while ($contador < $cantidad) {
        
        $evt = new Event;
        $evt->paciente=$request->id_paciente;
        $evt->profesional=36;
        $evt->date=date('Y-m-d');
        $evt->time=17;
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=0;
        $evt->sede=$request->session()->get('sede');
        $evt->tipo='CONTROLES';
        $evt->save();

           $contador++;
         }   

         } 
   


}
}
	
		
		

	//////////
		
				
			
					
    }

    if (isset($request->id_servicio)) {
     
	  
	
	  
	
      foreach ($request->id_servicio['servicios'] as $key => $servicio) {
        if (!is_null($servicio['servicio'])) {
              $serMateriales = ServicioMaterial::where('servicio_id', $servicio['servicio'])
                                        ->with('material', 'servicio')
                                        ->get();

          

              foreach ($serMateriales as $sm) {
                $sm->material->cantidad = $sm->material->cantidad - $sm->cantidad;
                $sm->material->save();
              }

               $searchServicio = DB::table('servicios')
              ->select('*')
              ->where('id','=', $servicio['servicio'])
              ->first();  
        
     // $porcentaje = $searchServicio->porcentaje;
    $programa = $searchServicio->programa;
    $sesion= $searchServicio->sesion;


              if ($request->origen == 1 ){
                $porcentaje = $searchServicio->por_per;
            } else {
                $porcentaje = $searchServicio->porcentaje;
            }

              $serv = new Atenciones();
              $serv->id_paciente = $request->id_paciente;
              $serv->origen = $request->origen;
              $serv->origen_usuario = 99999999;
              $serv->id_laboratorio =  1;
              $serv->id_paquete =  1;
              $serv->id_servicio =  $servicio['servicio'];
              $serv->es_servicio =  true;
			        $serv->serv_prog =  $programa;
              $serv->sesion =  $sesion;
              $serv->tipopago = $request->tipopago;
              $serv->porc_pagar = $porcentaje;
              $serv->comollego = $request->comollego;
              $serv->pendiente = (float)$request->monto_s['servicios'][$key]['monto'] - (float)$request->monto_abos['servicios'][$key]['abono'];
              $serv->monto = (float)$request->monto_s['servicios'][$key]['monto'];
              $serv->abono = (float)$request->monto_abos['servicios'][$key]['abono'];
              $serv->porcentaje = ((float)$request->monto_s['servicios'][$key]['monto']* $porcentaje)/100;
              $serv->id_sede = $request->session()->get('sede');
              $serv->estatus = 1;
              $serv->particular = $request->particular;
              $serv->usuario = Auth::user()->id;
              $serv->ticket =AtencionesController::generarId($request);
              $serv->save(); 

              $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $serv->id;
              $creditos->monto= $request->monto_abos['servicios'][$key]['abono'];
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();
        } else {

        }
      }
    }

    if (isset($request->id_laboratorio)) {

       $searchAnalisis = DB::table('analises')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id_laboratorio)
                    ->first();   
                   
                   $porcentaje =  $searchAnalisis->porcentaje;

          

      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {
          //dd($request->total_g);


           if ($request->origen == 2 ){
        $porcentaje = $searchAnalisis->porcentaje;
    } elseif($request->origen == 1) {
        $porcentaje = 0;
    } else {
      $porcentaje=0;
    }   


          $lab = new Atenciones();
          $lab->id_paciente = $request->id_paciente;
          $lab->origen = $request->origen;
          $lab->origen_usuario = 99999999;
          $lab->id_servicio = 1;
          $lab->id_paquete =  1;
          $lab->id_laboratorio =  $laboratorio['laboratorio'];
          $lab->es_laboratorio =  true;
          $lab->tipopago = $request->tipopago;
          $lab->porc_pagar = $porcentaje;
		      $lab->serv_prog = FALSE;
          $lab->comollego = $request->comollego;
          $lab->pendiente = (float)$request->monto_l['laboratorios'][$key]['monto'] - (float)$request->monto_abol['laboratorios'][$key]['abono'];
          $lab->monto = (float)$request->monto_l['laboratorios'][$key]['monto'];
          $lab->abono = (float)$request->monto_abol['laboratorios'][$key]['abono'];
          $lab->porcentaje = ((float)$request->monto_l['laboratorios'][$key]['monto']* $porcentaje)/100;
         // $lab->pendiente = $request->total_g;
          $lab->id_sede = $request->session()->get('sede');
          $lab->estatus = 1;
          $lab->particular = $request->particular;
       $lab->usuario = Auth::user()->id;
         $lab->ticket =AtencionesController::generarId($request);
          $lab->save();

          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $lab->id;
          $creditos->monto= $request->monto_abol['laboratorios'][$key]['abono'];
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = $request->tipopago;
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->save();
        } else {

        }
      }
    }
		
		
  } else {		
    
    $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('id','=', $request->origen_usuario)
                    ->first();    
 

    if (is_null($request->id_servicio['servicios'][0]['servicio']) && is_null($request->id_laboratorio['laboratorios'][0]['laboratorio'])){
      return redirect()->route('atenciones.create');
    }

    if (isset($request->id_paquete)) {
      
      foreach ($request->id_paquete['paquetes'] as $key => $paquete) {
        if (!is_null($paquete['paquete'])) {
              $paquete = Paquetes::findOrFail($paquete['paquete']);
              $paq = new Atenciones();
              $paq->id_paciente = $request->id_paciente;
              $paq->origen = $request->origen;
              $paq->origen_usuario = $searchUsuarioID->id;
              $paq->id_laboratorio =  1;
              $paq->id_servicio =  1;
              $paq->id_paquete = $paquete->id;
              $paq->comollego = $request->comollego;
              $paq->es_paquete =  true;
			      $paq->serv_prog = FALSE;
              $paq->tipopago = $request->tipopago;
              $paq->porc_pagar = $paquete->porcentaje;
              $paq->pendiente = (float)$request->monto_p['paquetes'][$key]['monto'] - (float)$request->monto_abop['paquetes'][$key]['abono'];
              $paq->monto = (float)$request->monto_p['paquetes'][$key]['monto'];
              $paq->abono = (float)$request->monto_abop['paquetes'][$key]['abono'];
              $paq->porcentaje = ((float)$request->monto_p['paquetes'][$key]['monto']* $paquete->porcentaje)/100;
              $paq->id_sede =$request->session()->get('sede');
              $paq->estatus = 1;
              $paq->particular = $request->particular;
                            $paq->usuario = Auth::user()->id;
                                          $paq->ticket =AtencionesController::generarId($request);
              $paq->save(); 

              $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $paq->id;
              $creditos->monto= $request->monto_abop['paquetes'][$key]['abono'];
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();


        } else {

        }
      }
	  //////
	   if(! is_null($request->id_paquete)){
     foreach ($request->id_paquete as $key => $value) {

        $searchServPaq = DB::table('paquete_servicios')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('paquete_id','=', $value)
        ->get();
		
		

        foreach ($searchServPaq as $serv) {
            $id_servicio = $serv->servicio_id;
			
			$servdetalle =  DB::table('servicios')
			->select('*')
			->where('id','=',$id_servicio)
			->first();
			
			$detalle = $servdetalle->detalle;
      $sesion= $servdetalle->sesion;

            if(! is_null($id_servicio)){
              $s = new Atenciones();
              $s->id_paciente = $request->id_paciente;
              $s->origen = $request->origen;
              $s->origen_usuario = $searchUsuarioID->id;
              $s->id_laboratorio =  1;
              $s->id_servicio =  $id_servicio;
              $s->id_paquete = 1;
              $s->comollego = $request->comollego;
              $s->es_paquete =  FALSE;
			        $s->es_servicio =  1;
              $s->es_laboratorio =  FALSE;
			        $s->serv_prog = FALSE;
              $s->tipopago = $request->tipopago;
              $s->porc_pagar = 0;
              $s->pendiente = 0;
              $s->monto = 99999;
              $s->sesion = $sesion;
              $s->abono = 0;
              $s->porcentaje =0;
              $s->id_sede =$request->session()->get('sede');
              $s->estatus = 1;
              $s->particular = $request->particular;
                            $s->usuario = Auth::user()->id;
                                          $s->ticket =AtencionesController::generarId($request);
              $s->save(); 
             
         }
        }

        $searchLabPaq = DB::table('paquete_laboratorios')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();

         foreach ($searchLabPaq as $lab) {
            $id_laboratorio = $lab->laboratorio_id;


            if(! is_null($id_laboratorio)){
			  $l = new Atenciones();
              $l->id_paciente = $request->id_paciente;
              $l->origen = $request->origen;
              $l->origen_usuario = $searchUsuarioID->id;
              $l->id_laboratorio = $id_laboratorio;
              $l->id_servicio = 1;
              $l->id_paquete = 1;
              $l->comollego = $request->comollego;
              $l->es_paquete =  FALSE;
			  $l->es_servicio =  FALSE;
              $l->es_laboratorio = 1;
			  $l->serv_prog = FALSE;
              $l->tipopago = $request->tipopago;
              $l->porc_pagar = 0;
              $l->pendiente = 0;
              $l->monto = 99999;
              $l->abono = 0;
              $l->porcentaje =0;
              $l->id_sede =$request->session()->get('sede');
              $l->particular = $request->particular;
              $l->estatus = 1;
              $l->usuario = Auth::user()->id;
                            $l->ticket =AtencionesController::generarId($request);
              $l->save(); 

         }
        }

        $paciente = DB::table('pacientes')
        ->select('*')
        ->where('id','=', $request->id_paciente)
        ->first();

        $searchConsPaq = DB::table('paquete_consultas')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();

        
        if(count($searchConsPaq) > 0){
    
          foreach ($searchConsPaq as $cons) {
            $cantidad=$cons->cantidad;
             }



         $contador=0;
         
        while ($contador < $cantidad) {
        
        $evt = new Event;
        $evt->paciente=$request->id_paciente;
        $evt->profesional=36;
        $evt->date=date('Y-m-d');
        $evt->time=17;
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=0;
        $evt->sede=$request->session()->get('sede');
        $evt->tipo='CONSULTAS';
        $evt->save();

           $contador++;
         } 

          } 

$paciente = DB::table('pacientes')
        ->select('*')
        ->where('id','=', $request->id_paciente)
        ->first();

           $searchContPaq = DB::table('paquete_controles')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();


        

        if(count($searchContPaq) > 0){


          foreach ($searchContPaq as $cons) {
            $cantidad=$cons->cantidad;
             }



         $contador=0;
         
        while ($contador < $cantidad) {
        
        $evt = new Event;
        $evt->paciente=$request->id_paciente;
        $evt->profesional=36;
        $evt->date=date('Y-m-d');
        $evt->time=17;
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=0;
        $evt->sede=$request->session()->get('sede');
        $evt->tipo='CONTROLES';
        $evt->save();

           $contador++;
         }   

          }   
   



        ////
        /*EJEMPLO

         $contador=1;
          if(count($searchContador) ==0){
            $contador=1;
          
            $correlativo = new Correlativo;
            $correlativo->contador=$contador;
            $correlativo->id_org=$id_org;
            $correlativo->id_dep=$id_dep;
            $correlativo->id_tipo_correspondencia=$id_tipo_correspondencia;
            $correlativo->tipo_correlativo='2';
            $correlativo->save();

          
        } else {
         foreach ($searchContador as $correlativo){
            $contador=$correlativo->contador+1;

         
            $correlativo=Correlativo::findOrFail($correlativo->id);
            $correlativo->contador=$contador;
            $correlativo->updated_at=date('Y-m-d H:i:s');
            $correlativo->update();

        } 




        */


}
}
	  //////
    }

    if (isset($request->id_servicio)) {
      

	
	  
	
      foreach ($request->id_servicio['servicios'] as $key => $servicio) {
        if (!is_null($servicio['servicio'])) {
              $serMateriales = ServicioMaterial::where('servicio_id', $servicio['servicio'])
                                        ->with('material', 'servicio')
                                        ->get();
    $searchServicio = DB::table('servicios')
              ->select('*')
              ->where('id','=', $servicio['servicio'])
              ->first();  
        
     // $porcentaje = $searchServicio->porcentaje;
    $programa = $searchServicio->programa;
    $sesion = $searchServicio->sesion;


                
    if ($request->origen == 1 ){
        $porcentaje = $searchServicio->por_per;
    } else {
        $porcentaje = $searchServicio->porcentaje;
    }

              foreach ($serMateriales as $sm) {
                $sm->material->cantidad = $sm->material->cantidad - $sm->cantidad;
                $sm->material->save();
              }
              $serv = new Atenciones();
              $serv->id_paciente = $request->id_paciente;
              $serv->origen = $request->origen;
              $serv->origen_usuario = $searchUsuarioID->id;
              $serv->id_laboratorio =  1;
              $serv->id_paquete =  1;
              $serv->id_servicio =  $servicio['servicio'];
              $serv->es_servicio =  true;
			        $serv->serv_prog =  $programa;
              $serv->sesion =  $sesion;
              $serv->tipopago = $request->tipopago;
              $serv->porc_pagar = $porcentaje;
              $serv->comollego = $request->comollego;
              $serv->pendiente = (float)$request->monto_s['servicios'][$key]['monto'] - (float)$request->monto_abos['servicios'][$key]['abono'];
              $serv->monto = (float)$request->monto_s['servicios'][$key]['monto'];
              $serv->abono = (float)$request->monto_abos['servicios'][$key]['abono'];
              $serv->porcentaje = ((float)$request->monto_s['servicios'][$key]['monto']* $porcentaje)/100;
              $serv->id_sede = $request->session()->get('sede');
              $serv->estatus = 1;
              $serv->particular = $request->particular;
              $serv->ticket =AtencionesController::generarId($request);
              $serv->usuario = Auth::user()->id;
              $serv->save(); 

              $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $serv->id;
              $creditos->monto= $request->monto_abos['servicios'][$key]['abono'];
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();
        } else {

        }
      }
    }

    if (isset($request->id_laboratorio)) {

                   


      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {


       $searchAnalisis = DB::table('analises')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $laboratorio['laboratorio'])
                    ->first();   

                             
    if ($request->origen == 2 ){
        $porcentaje = $searchAnalisis->porcentaje;
    } else {
      $porcentaje=0;
    }   

          $lab = new Atenciones();
          $lab->id_paciente = $request->id_paciente;
          $lab->origen = $request->origen;
          $lab->origen_usuario = $searchUsuarioID->id;
          $lab->id_servicio = 1;
          $lab->id_paquete =  1;
          $lab->id_laboratorio =  $laboratorio['laboratorio'];
          $lab->es_laboratorio =  true;
          $lab->tipopago = $request->tipopago;
          $lab->porc_pagar = $porcentaje;
		  $lab->serv_prog = FALSE;
          $lab->comollego = $request->comollego;
          $lab->pendiente = (float)$request->monto_l['laboratorios'][$key]['monto'] - (float)$request->monto_abol['laboratorios'][$key]['abono'];
          $lab->monto = (float)$request->monto_l['laboratorios'][$key]['monto'];
          $lab->abono = (float)$request->monto_abol['laboratorios'][$key]['abono'];
          $lab->porcentaje = ((float)$request->monto_l['laboratorios'][$key]['monto']* $porcentaje)/100;
         // $lab->pendiente = $request->total_g;
          $lab->id_sede = $request->session()->get('sede');
          $lab->estatus = 1;
          $lab->particular = $request->particular;
          $lab->usuario = Auth::user()->id;
         $lab->ticket =AtencionesController::generarId($request);
          $lab->save();

          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $lab->id;
          $creditos->monto= $request->monto_abol['laboratorios'][$key]['abono'];
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = $request->tipopago;
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->save();
        } else {

        }
      }
    }
	}
	
	
    	 Toastr::success('Registrado Exitosamente.', 'Ingreso de Atenciòn!', ['progressBar' => true]);


    return redirect()->route('atenciones.index');
     
  }

  public function personal(){
     
       $personal = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('tipo','=','1')
                    ->orderBy('lastname','asc')
                    ->get();  

    return view('movimientos.atenciones.personal', compact('personal'));
  }

   public function profesional(){
     
        $profesional = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('tipo','=','2')
                    ->orderBy('lastname','asc')
                    ->whereNotIn('id',[99999999])
                    ->get();  

    return view('movimientos.atenciones.profesional', compact('profesional'));
  }
  
  public function particular(){
     
    return view('movimientos.atenciones.particular');
  }

  public function editView($id)
  {
    //$servicios = Servicios::all();
    //$laboratorios = Analisis::all();
    //$pacientes = Pacientes::all();

    $servicios =Servicios::where("estatus", '=', 1)->get();
    $laboratorios =Analisis::where("estatus", '=', 1)->get();
    $pacientes =Pacientes::where("estatus", '=', 1)->get();
    $paquetes =Paquetes::where("estatus", '=', 1)->get();
    //$personal = Personal::all();
    //$profesional = Profesionales::all();
    $users = User::all();

    $atencion = Atenciones::findOrFail($id);
    
    return view('movimientos.atenciones.edit', compact('atencion','servicios','laboratorios','pacientes', 'users'));
  }

  public function edit(Request $request, $id)
  {
    $atencion = Atenciones::findOrFail($id);
    
    $creditos = Creditos::where('id_atencion', $atencion->id)->first();

    
    $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('id','=', $request->origen_usuario)
                    ->first();       
                    
    if (isset($request->id_servicio)) {
      $atencion->origen = $request->origen;
      $atencion->origen_usuario = $searchUsuarioID->id;
      $atencion->id_servicio =  $request->id_servicio['servicios'][0]['servicio'];
      $atencion->es_servicio =  true;
      $atencion->tipopago = $request->tipopago;
      $atencion->pendiente = (float)$request->monto_s['servicios'][0]['monto'] - (float)$request->monto_abos['servicios'][0]['abono'];
      $atencion->monto = $request->monto_s['servicios'][0]['monto'];
      $atencion->abono = $request->monto_abos['servicios'][0]['abono'];

      $creditos->monto= $request->monto_abos['servicios'][0]['abono'];
      $creditos->tipo_ingreso = $request->tipopago;
    } else {
      $atencion->origen = $request->origen;
      $atencion->origen_usuario = $searchUsuarioID->id;
      $atencion->id_laboratorio =  $request->id_laboratorio['laboratorios'][0]['laboratorio'];
      $atencion->tipopago = $request->tipopago;
      $atencion->pendiente = (float)$request->monto_s['laboratorios'][0]['monto'] - (float)$request->monto_abos['laboratorios'][0]['abono'];
      $atencion->monto = $request->monto_l['laboratorios'][0]['monto'];
      $atencion->abono = $request->monto_abol['laboratorios'][0]['abono'];

      $creditos->monto= $request->monto_abol['laboratorios'][0]['abono'];
      $creditos->tipo_ingreso = $request->tipopago;
    }

    if ($atencion->save() && $creditos->save()) {
      return redirect()->route('atenciones.index');
    } else {
      throw new Exception("Error en el proceso de actualizaciÃ³n", 1);
    }
  }

  /*private function elasticSearch(Request $request)
  {
    $atenciones = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.detalle as paquete')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->join('paquetes as f','f.id','a.id_paquete')
    ->whereNotIn('a.monto',[0,0.00,99999])
    //->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
    ->where('a.id_sede','=', $request->session()->get('sede'))
    ->orderby('a.id','desc')
    ->paginate(20);
	
	

    return $atenciones;
  }*/

    private function elasticSearch($initial,$nombre,$apellido,Request $request)
  {
    $atenciones = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->join('users as h','h.id','a.usuario')
    ->join('paquetes as f','f.id','a.id_paquete')
    ->whereNotIn('a.monto',[0,0.00,99999])
    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
    ->where('a.id_sede','=', $request->session()->get('sede'))
    ->where('b.nombres','like','%'.$nombre.'%')
    ->where('b.apellidos','like','%'.$apellido.'%')
    ->orderby('a.id','desc')
    ->groupBy('a.id')
    ->get();
  
  

    return $atenciones;
  }
  
   public function delete($id){
    $atenciones = Atenciones::find($id);
    $atenciones->delete();
	
	$creditos = Creditos::where('id_atencion','=',$id);
    $creditos->delete();
  
	 Toastr::error('Eliminado Exitosamente.', 'Ingreso de Atenciòn!', ['progressBar' => true]);

     return redirect()->action('AtencionesController@index', ["created" => true, "atenciones" => Atenciones::all()]);
	
  }
  
  public function asoc(Request $request,$id){
    $atenciones = Atenciones::find($id);
	$atenciones->informe = $request->informe;
    $atenciones->save();
	
	$creditos = Creditos::where('id_atencion','=',$id);
    $creditos->delete();
  
	 Toastr::error('Eliminado Exitosamente.', 'Ingreso de Atenciòn!', ['progressBar' => true]);

     return redirect()->action('AtencionesController@index', ["created" => true, "atenciones" => Atenciones::all()]);
	
  }
}
