<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use App\Models\ResultadosServicios;
use App\Models\ResultadosLaboratorios;
use Carbon\Carbon;
use Auth;


class ResultadosGuardadosController extends Controller

{

	public function index(){

     $initial = Carbon::now()->toDateString();
     $resultadosguardados = $this->elasticSearch($initial);

       return view('resultadosguardados.index', [
      "icon" => "fa-list-alt",
      "model" => "atenciones",
      "headers" => ["Nombre Paciente", "Apellido Paciente","Nombre Origen","Apellido Origen","Servicio","Laboratorio","Paquete","Monto","Monto Abonado","Fecha","Editar", "Eliminar"],
      "data" => $resultadosguardados,
      "fields" => ["nombres", "apellidos","name","lastname","servicio","laboratorio","paquete","monto","abono","created_at"],
      "actions" => [
        '<button type="button" class="btn btn-info">Transferir</button>',
        '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]); 
	}

   public function search(Request $request){
      //Pendiente Validar Fechas de entrada, lo hago despues
      $resultadosguardados = $this->elasticSearch($request->inicio);

    return view('resultadosguardados.search', ["resultadosguardados" => $resultadosguardados]);

  }

   private function elasticSearch($initial)
  {

   $resultadosguardados = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.created_at','a.abono','a.pendiente','a.es_servicio','a.es_laboratorio','a.es_paquete','a.resultado','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        ->where('a.id_sede','=', \Session::get("sede"))
        ->where('a.resultado','=', 1)
        ->orderby('a.id','desc')
        ->paginate(20);

    return $resultadosguardados;
  }


	public function editView($id){

    $atencion = Atenciones::findOrFail($id);

    return view('resultados.create', compact('atencion'));

    }

	 public function edit($id,Request $request){


     $searchAtenciones = DB::table('atenciones')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->get();

            foreach ($searchAtenciones as $atenciones) {
                    $es_servicio = $atenciones->es_servicio;
                    $es_laboratorio = $atenciones->es_laboratorio;
                }

        if (!is_null($es_servicio)) {

           $searchAtencionesServicios = DB::table('atenciones')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->get();

            foreach ($searchAtencionesServicios as $servicios) {
                    $id_servicio = $servicios->id_servicio;
                }

                $p = Atenciones::findOrFail($id);
                $p->resultado = 1;
                $p->save();


                $creditos = new ResultadosServicios();
                $creditos->id_atencion = $request->id;
                $creditos->id_servicio = $id_servicio;
                $creditos->descripcion= $request->descripcion;
                $creditos->save();

       } else {

           $searchAtencionesLaboratorios = DB::table('atenciones')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->get();

            foreach ($searchAtencionesLaboratorios as $laboratorio) {
                    $id_laboratorio = $laboratorio->id_laboratorio;
                }


                 $p = Atenciones::findOrFail($id);
                $p->resultado = 1;
                $p->save();


                $creditos = new ResultadosLaboratorios();
                $creditos->id_atencion = $request->id;
                $creditos->id_laboratorio = $id_laboratorio;
                $creditos->descripcion= $request->descripcion;
                $creditos->save();

       }
                
      return redirect()->action('ResultadosController@index');

    }

 //

    }


