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
use App\Informe;
use Auth;


class ResultadosController extends Controller

{

	public function index(){


      	$resultados = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->whereNotIn('a.monto',[0,0.00])
        ->where('a.resultado','=', NULL)
        ->orderby('a.id','desc')
        ->paginate(5000);


        $informe = Informe::all();

         return view('generics.index3', [
        "icon" => "fa-list-alt",
        "model" => "resultados",
        "headers" => ["Nombre Paciente", "Apellido Paciente","Nombre Profesional","Apellido Profesional","Servicio","laboratorio","Acción","Tipo Informe"],
        "data" => $resultados,
        "informes" => $informe,
        "fields" => ["nombres", "apellidos","name","lastname","servicio","laboratorio"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]); 
	}


	public function editView($id, Request $request){

    $atencion = Atenciones::findOrFail($id);
    $informe = Informe::where('id',$request->informe)->first();

    return view('resultados.create', [
      'atencion' => $atencion,
      'informe' => $informe
      ]);

    }


    public function informe()
    {
      return view ('informe.create');
    }

    public function informeIndex()
    {
      $informes = Informe::orderBy('id','desc')->get();

      return view('informe.index',[
        'data' => $informes
      ]);
    }

    public function informeEditar(Informe $id)
    {
      return view('informe.edit',[
        'data' => $id
      ]);
    }

    public function informeEdit(Informe $id, Request $request)
    {
      $id->update($request->all());

      return back();
    }

    
    public function informeCreate(Request $request)
    {
      $informe = Informe::create([
        'title' => $request->title,
        'content' => $request->content,
        'reporte_id' => '1'
      ]);

      return back();
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


