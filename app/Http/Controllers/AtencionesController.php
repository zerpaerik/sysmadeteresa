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

use Auth;


class AtencionesController extends Controller

{

	public function index(){


      	$atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.id_servicio','a.id_laboratorio','a.monto','a.porcentaje','a.abono','b.name as paciente','c.name as profesional','d.detalle as servicio')
        ->join('users as b','a.id_paciente','b.id')
        ->join('users as c','a.origen_usuario','c.id')
        ->join('servicios as d','a.id_servicio','d.id')
        ->join('analises as e','a.id_laboratorio','e.id')
        ->orderby('a.id','desc')
        ->paginate(5000);

        return view('generics.index', [
        "icon" => "fa-list-alt",
        "model" => "atenciones",
        "headers" => ["id", "Paciente", "Origen", "Servicio", "Laboratorio", "Total","porcentaje","Abonado Total", "Editar", "Eliminar"],
        "data" => $atenciones,
        "fields" => ["id", "paciente", "profesional", "servicio", "laboratorio", "monto", "porcentaje", "abono"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  

	}

	public function createView() {

    $servicios = Servicios::all();
    $laboratorios = Analisis::all();
    $pacientes = Pacientes::all();
    
    return view('movimientos.atenciones.create', compact('servicios','laboratorios','pacientes'));
  }

  public function create(Request $request)
  {
    if (isset($request->id_servicio)) {
      foreach ($request->id_servicio['servicios'] as $key => $servicio) {
        $serv = new Atenciones();
        $serv->id_paciente = $request->id_paciente;
        $serv->origen = $request->origen;
        $serv->origen_usuario = $request->origen_usuario;
        $serv->id_servicio =  $servicio['servicio'];
        $serv->es_servicio =  true;
        $serv->monto = $request->monto_s['servicios'][$key]['monto'];
        $serv->id_sede = $request->session()->get('sede');
        $serv->estatus = 1;
        $serv->save();
      }
    }

    if (isset($request->id_laboratorio)) {
      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        $lab = new Atenciones();
        $lab->id_paciente = $request->id_paciente;
        $lab->origen = $request->origen;
        $lab->origen_usuario = $request->origen_usuario;
        $lab->id_laboratorio =  $laboratorio['laboratorio'];
        $lab->es_laboratorio =  true;
        $lab->monto = $request->monto_l['laboratorios'][$key]['monto'];
        $lab->id_sede = $request->session()->get('sede');
        $lab->estatus = 1;
        $lab->save();
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
