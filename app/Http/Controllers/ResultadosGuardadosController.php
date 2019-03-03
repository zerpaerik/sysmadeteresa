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
use Toastr;


class ResultadosGuardadosController extends Controller

{

	public function index(){

     $initial = Carbon::now()->toDateString();
     $resultadosguardados = $this->elasticSearch();

       return view('resultadosguardados.index', ['resultadosguardados' => $resultadosguardados]); 
	}
	
	public function index1(){

     $initial = Carbon::now()->toDateString();
     $resultadosguardados = $this->elasticSearch1($initial);

      return view('resultadosguardados.index1', ["resultadosguardados" => $resultadosguardados]);

	}

   public function search(Request $request){
      //Pendiente Validar Fechas de entrada, lo hago despues
      $resultadosguardados = $this->elasticSearch($request->inicio);

    return view('resultadosguardados.search', ["resultadosguardados" => $resultadosguardados]);

  }
  
   public function search1(Request $request){
      //Pendiente Validar Fechas de entrada, lo hago despues
      $resultadosguardados = $this->elasticSearch1($request->inicio);

    return view('resultadosguardados.search1', ["resultadosguardados" => $resultadosguardados]);

  }

   private function elasticSearch()
  {

   $resultadosguardados = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.created_at','a.abono','a.pendiente','a.es_servicio','a.es_laboratorio','a.es_paquete','a.resultado','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','r.informe','r.id as id2')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
		     ->join('resultados_servicios as r','a.id','r.id_atencion')
         ->where('a.es_servicio','=',1)
       // ->whereNotIn('a.monto',[0,0.00])
        //->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        ->where('a.id_sede','=', \Session::get("sede"))
        ->where('a.resultado','=', 1)
        ->orderby('a.id','desc')
        ->get();

    return $resultadosguardados;
  }
  
    public function editars($id){

    $atencion = ResultadosServicios::findOrFail($id);
    return view('resultadosguardados.editars', compact('atencion'));

    }
	
	 public function editarl($id){

    $atencion = ResultadosLaboratorios::findOrFail($id);
    return view('resultadosguardados.editar', compact('atencion'));

    }
	
	public function edits($id,Request $request){

     
		$imgname = DB::table('resultados_servicios')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('informe','=', $request->file('informe')->getClientOriginalName())
                    ->first();
				
			   if($imgname){
				        Toastr::error('Ya Existe un archivo con ese Nombre.', 'INFORME DE RESULTADOS!', ['progressBar' => true]);
						return redirect()->action('ResultadosGuardadosController@index');

			   } else {
				     
                $resultado = ResultadosServicios::findOrFail($id);
				$img = $request->file('informe');
				$nombre_imagen=$img->getClientOriginalName();
				$resultado->informe=$nombre_imagen;
				if ($resultado->save()) {
					 \Storage::disk('public')->put($nombre_imagen,  \File::get($img));

				}
				\DB::commit();
				
			   }

      
       	 Toastr::success('Actualizado Exitosamente.', 'INFORME DE RESULTADOS!', ['progressBar' => true]);
      return redirect()->action('ResultadosGuardadosController@index');

    }
	
	public function editl($id,Request $request){

     
		$imgname = DB::table('resultados_laboratorios')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('informe','=', $request->file('informe')->getClientOriginalName())
                    ->first();
				
			   if($imgname){
				        Toastr::error('Ya Existe un archivo con ese Nombre.', 'INFORME DE RESULTADOS!', ['progressBar' => true]);
						return redirect()->action('ResultadosGuardadosController@index1');

			   } else {
				     
                $resultado = ResultadosLaboratorios::findOrFail($id);
				$img = $request->file('informe');
				$nombre_imagen=$img->getClientOriginalName();
				$resultado->informe=$nombre_imagen;
				if ($resultado->save()) {
					 \Storage::disk('public')->put($nombre_imagen,  \File::get($img));

				}
				\DB::commit();
				
			   }

      
       	 Toastr::success('Actualizado Exitosamente.', 'INFORME DE RESULTADOS!', ['progressBar' => true]);
      return redirect()->action('ResultadosGuardadosController@index1');

    }
  
   private function elasticSearch1($initial)
  {

   $resultadosguardados = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.created_at','a.abono','a.pendiente','a.es_servicio','a.es_laboratorio','a.es_paquete','a.resultado','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','r.informe','r.id as id2')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
		    ->join('resultados_laboratorios as r','a.id','r.id_atencion')
        ->where('a.es_laboratorio','=',1)
        ->where('a.id_sede','=', \Session::get("sede"))
        ->where('a.resultado','=', 1)
        ->orderby('a.id','desc')
        ->get();

    return $resultadosguardados;
  }



	public function editView($id){

    $atencion = Atenciones::findOrFail($id);

    return view('resultados.create', compact('atencion'));

    }
	
	public function guardar($id){

    $atencion = Atenciones::findOrFail($id);

    return view('resultados.guardar', compact('atencion'));

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
                
      return redirect()->action('ResultadosGuardadosController@index');

    }

     public function reversar($id,$id2){


                $p = Atenciones::findOrFail($id);
                $p->informe =NULL;
                $p->resultado =NULL;
                $p->save();


                $resultadosg = ResultadosServicios::findOrFail($id2);
                $resultadosg->delete();

      return redirect()->action('ResultadosGuardadosController@index');

    }


     public function reversarl($id,$id2){


                $p = Atenciones::findOrFail($id);
                $p->informe =NULL;
                $p->resultado =NULL;
                $p->save();


                $resultadosg = ResultadosLaboratorios::findOrFail($id2);
                $resultadosg->delete();

      return redirect()->action('ResultadosGuardadosController@index');

    }

 //

    }


