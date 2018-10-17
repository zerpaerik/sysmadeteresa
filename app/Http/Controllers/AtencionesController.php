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
use Auth;


class AtencionesController extends Controller

{

	public function index(){


      	$atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.name as nompro','f.apellidos as apepro')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('profesionales as f','f.id','a.origen_usuario')
        ->orderby('a.id','desc')
        ->paginate(5000);


        return view('movimientos.atenciones.index', ["atenciones" => $atenciones]);
	}

	public function createView() {

    $servicios = Servicios::all();
    $laboratorios = Analisis::all();
    $pacientes = Pacientes::all();
    
    return view('movimientos.atenciones.create', compact('servicios','laboratorios','pacientes'));
  }

  public function create(Request $request)
  {

      $searchUsuarioID = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->origen_usuario)
                    ->first();                    
                    //->get();
                    
                    $usuarioID = $searchUsuarioID->id;




    if (is_null($request->id_servicio['servicios'][0]['servicio']) && is_null($request->id_laboratorio['laboratorios'][0]['laboratorio'])){
      return redirect()->route('atenciones.create');
    }

    if (isset($request->id_servicio)) {
      foreach ($request->id_servicio['servicios'] as $key => $servicio) {
        if (!is_null($servicio['servicio'])) {
              $serv = new Atenciones();
              $serv->id_paciente = $request->id_paciente;
              $serv->origen = $request->origen;
              $serv->origen_usuario = $usuarioID;
              $serv->id_servicio =  $servicio['servicio'];
              $serv->id_laboratorio = 1;
              $serv->es_servicio =  true;
              $serv->tipopago = $request->tipopago;
              $serv->es_laboratorio =  false;
              $serv->pagado_lab = false;
              $serv->pagado_com = false;
              $serv->resultado = false;
              $serv->monto = $request->monto_s['servicios'][$key]['monto'];
              $serv->abono = $request->monto_abos['servicios'][$key]['abono'];
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


        }
      }
    }

    if (isset($request->id_laboratorio)) {
      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {
          $lab = new Atenciones();
          $lab->id_paciente = $request->id_paciente;
          $lab->origen = $request->origen;
          $lab->origen_usuario = $usuarioID;
          $lab->id_servicio = 1;
          $lab->id_laboratorio =  $laboratorio['laboratorio'];
          $lab->es_laboratorio =  true;
          $lab->tipopago = $request->tipopago;
          $lab->es_servicio =  false;
          $lab->pagado_lab = false;
          $lab->pagado_com = false;
          $lab->resultado = false;
          $lab->monto = $request->monto_l['laboratorios'][$key]['monto'];
          $lab->abono = $request->monto_abol['laboratorios'][$key]['abono'];
          $lab->id_sede = $request->session()->get('sede');
          $lab->estatus = 1;
          $lab->save();

          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $lab->id;
          $creditos->monto= $request->monto_abos['servicios'][$key]['abono'];
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = $request->tipopago;
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->save();
        }
      }
    }

    return redirect()->route('atenciones.index');
  }

  public function personal(){
     
      $personal = Personal::all();
 
    return view('movimientos.atenciones.personal', compact('personal'));


  }

   public function profesional(){
     
      $profesional = Profesionales::all();
 
    return view('movimientos.atenciones.profesional', compact('profesional'));


  }

    //
}
