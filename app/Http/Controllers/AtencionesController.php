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
use App\Models\Existencias\Producto;
use App\Models\ServicioMaterial;
use App\User;
use Auth;
use Carbon\Carbon;
use Toastr;

class AtencionesController extends Controller

{

	public function index(){
    $initial = Carbon::now()->toDateString();
    $atenciones = $this->elasticSearch($initial,'','');
    return view('movimientos.atenciones.index', [
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

    public function search(Request $request){

    $search = $request->nom;
    $split = explode(" ",$search);

    if (!isset($split[1])) {
     
      $split[1] = '';
      $atenciones = $this->elasticSearch($request->inicio,$split[0],$split[1]);
      
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
    }else{
      $atenciones = $this->elasticSearch($request->inicio,$split[0],$split[1]);  

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
    $servicios =Servicios::where("estatus", '=', 1)->get();
    $laboratorios =Analisis::where("estatus", '=', 1)->get();
    $pacientes =Pacientes::where("estatus", '=', 1)->get();
    $paquetes =Paquetes::where("estatus", '=', 1)->get();


    
    return view('movimientos.atenciones.create', compact('servicios','laboratorios','pacientes','paquetes'));
  }

  public function create(Request $request)
  {
    
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
              $paq->tipopago = $request->tipopago;
              $paq->porc_pagar = $paquete->porcentaje;
              $paq->pendiente = (float)$request->monto_p['paquetes'][$key]['monto'] - (float)$request->monto_abop['paquetes'][$key]['abono'];
              $paq->monto = $request->monto_p['paquetes'][$key]['monto'];
              $paq->abono = $request->monto_abop['paquetes'][$key]['abono'];
              $paq->porcentaje = ((float)$request->monto_p['paquetes'][$key]['monto']* $paquete->porcentaje)/100;
              $paq->id_sede = $request->session()->get('sede');
              $paq->estatus = 1;
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
    }

    if (isset($request->id_servicio)) {
      $searchServicio = DB::table('servicios')
              ->select('*')
              ->where('id','=', $request->id_servicio)
              ->first();   
      $porcentaje = ($request->origen == 1) ? $searchServicio->por_per : $searchServicio->porcentaje;

      foreach ($request->id_servicio['servicios'] as $key => $servicio) {
        if (!is_null($servicio['servicio'])) {
              $serMateriales = ServicioMaterial::where('servicio_id', $servicio['servicio'])
                                        ->with('material', 'servicio')
                                        ->get();

              foreach ($serMateriales as $sm) {
                if ($sm->material->cantidad < $sm->cantidad) {
                  Toastr::error('El servicio '.$sm->servicio->detalle.' no se puede ofrecer', 'Servicio', ['progressBar' => true]);
                  Toastr::error('No se tiene la cantidad suficiente de '.$sm->material->nombre, 'Material', ['progressBar' => true]);
                  return back();
                }
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
              $serv->tipopago = $request->tipopago;
              $serv->porc_pagar = $porcentaje;
              $serv->comollego = $request->comollego;
              $serv->pendiente = (float)$request->monto_s['servicios'][$key]['monto'] - (float)$request->monto_abos['servicios'][$key]['abono'];
              $serv->monto = $request->monto_s['servicios'][$key]['monto'];
              $serv->abono = $request->monto_abos['servicios'][$key]['abono'];
              $serv->porcentaje = ((float)$request->monto_s['servicios'][$key]['monto']* $porcentaje)/100;
              $serv->id_sede = $request->session()->get('sede');
              $serv->estatus = 1;
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
          $lab->comollego = $request->comollego;
          $lab->pendiente = (float)$request->monto_l['laboratorios'][$key]['monto'] - (float)$request->monto_abol['laboratorios'][$key]['abono'];
          $lab->monto = $request->monto_l['laboratorios'][$key]['monto'];
          $lab->abono = $request->monto_abol['laboratorios'][$key]['abono'];
          $lab->porcentaje = ((float)$request->monto_l['laboratorios'][$key]['monto']* $porcentaje)/100;
          $lab->pendiente = $request->total_g;
          $lab->id_sede = $request->session()->get('sede');
          $lab->estatus = 1;
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
    
    return redirect()->route('atenciones.index');
  }

  public function personal(){
     
       $personal = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('tipo','=','1')
                    ->get();  

    return view('movimientos.atenciones.personal', compact('personal'));
  }

   public function profesional(){
     
        $profesional = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('tipo','=','2')
                    ->get();  

    return view('movimientos.atenciones.profesional', compact('profesional'));
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
      throw new Exception("Error en el proceso de actualización", 1);
    }
  }

  private function elasticSearch($initial,$nombre,$apellido)
  {
    $atenciones = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.detalle as paquete')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->join('paquetes as f','f.id','a.id_paquete')
    ->whereNotIn('a.monto',[0,0.00])
    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
    ->where('a.id_sede','=', \Session::get("sede"))
    ->where('b.nombres','like','%'.$nombre.'%')
    ->where('b.apellidos','like','%'.$apellido.'%')
    ->orderby('a.id','desc')
    ->paginate(20);

    return $atenciones;
  }
}
