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
use App\Models\ResultadosMateriales;
use App\Models\Existencias\Producto;
use App\Informe;
use Auth;
use Toastr;


class ResultadosController extends Controller

{

	public function index(Request $request){


      	$resultados = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.informe','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.id_sede','=',$request->session()->get('sede'))
		    // ->where('a.es_paquete','<>',1)
        ->whereNotIn('a.monto',[0,0.00])
        ->where('a.resultado','=', NULL)
        ->orderby('a.id','desc')
        ->paginate(10);
        $informe = Informe::all();

         return view('resultados.index', [
        "icon" => "fa-list-alt",
        "model" => "resultados",
        "data" => $resultados,
        "informes" => $informe,
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]); 
	}

  public function search(Request $request)
  {
    $search = $request->nom;
    $split = explode(" ",$search);

    if (!isset($split[1])) {
      $split[1] = '';
      return $this->elasticSearch($split[0],$split[1]);
    }else{
      return $this->elasticSearch($split[0],$split[1]);     
    }
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
      $informes = Informe::orderBy('id','desc')->paginate(10);

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

    public function informeSearch(Request $request)
    {
      $informe = Informe::where('title','like','%'.$request->title.'%')->get();

      return view('informe.search',[
        'data' => $informe
      ]);
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
	
    public function guardar($id,Request $request){

    $atencion = Atenciones::findOrFail($id);
		$productos = Producto::where('almacen','=',2)->where("sede_id", "=", $request->session()->get('sede'))->get();


    return view('resultados.guardar', compact('atencion','productos'));

    }
	
	 public function edit1($id,Request $request){

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

          $searchServicioTec = DB::table('servicios')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id_servicio)
                    ->get();

            foreach ($searchServicioTec as $servicios) {
                    $por_tec = $servicios->por_tec;
                }



          if ($por_tec > 0) {
                
                $p = Atenciones::findOrFail($id);
                $p->resultado = 1;  
                $p->pago_com_tec = 0;      
                $p->save();

          } else {


          }


              /*  $creditos = new ResultadosServicios();
                $creditos->id_atencion = $request->id;
                $creditos->id_servicio = $id_servicio;
                $creditos->descripcion= $request->descripcion;
                $creditos->user_id = Auth::user()->id;
                $creditos->save();*/
				
				
		$imgname = DB::table('resultados_servicios')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('informe','=', $request->file('informe')->getClientOriginalName())
                    ->first();
				
			   if($imgname){
				        Toastr::error('Ya Existe un archivo con ese Nombre.', 'INFORME DE RESULTADOS!', ['progressBar' => true]);
						return redirect()->action('ResultadosController@index');

			   } else {
				   
				$p = Atenciones::findOrFail($id);
                $p->resultado = 1;  
                $p->save();   
				
				$product=new ResultadosServicios;
				$img = $request->file('informe');
				$nombre_imagen=$img->getClientOriginalName();
				$product->id_atencion=$request->id;
				$product->id_servicio=$id_servicio;
				$product->informe=$nombre_imagen;
				$product->user_id=Auth::user()->id;
				if ($product->save()) {
					 \Storage::disk('public')->put($nombre_imagen,  \File::get($img));

				}
				\DB::commit();
				

				////PARA MATERIALES
				 if (isset($request->id_laboratorio)) {
				  foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
					if (!is_null($laboratorio['laboratorio'])) {
					  $pro = new ResultadosMateriales();
					  $pro->id_resultado = $product->id;
					  $pro->id_material =  $laboratorio['laboratorio'];
					  $pro->cantidad = $request->monto_abol['laboratorios'][$key]['abono'];
					  $pro->save();
					  
					  $SearchMaterial = Producto::where('id', $laboratorio['laboratorio'])
					  ->first();
					  $cantactual= $SearchMaterial->cantidad;
				
					
				  $p = Producto::find($laboratorio['laboratorio']);
				  $p->cantidad = $cantactual - $request->monto_abol['laboratorios'][$key]['abono'];
				  $res = $p->save();
				  
					} 
				  }
				}
				//////
			   }

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
				
				$product=new ResultadosLaboratorios;
				$img = $request->file('informe');
				$nombre_imagen=$img->getClientOriginalName();
				$product->id_atencion=$request->id;
				$product->id_laboratorio=$id_laboratorio;
				$product->informe=$nombre_imagen;
				$product->user_id=Auth::user()->id;
				if ($product->save()) {
					 \Storage::disk('public')->put($nombre_imagen,  \File::get($img));

				}
				\DB::commit();

       }
          
       	 Toastr::success('Adjuntado Exitosamente.', 'INFORME DE RESULTADOS!', ['progressBar' => true]);

		 
      return redirect()->action('ResultadosController@index');

    }
	
	 public function asoc($id,Request $request){

      $p = Atenciones::findOrFail($id);
      $p->informe = $request->informe;
      $p->save();    
      return redirect()->action('ResultadosController@index');

    }
	
	


    private function elasticSearch($nom, $ape)
    {     
      $resultados = DB::table('atenciones as a')
      ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','a.resultado','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
      ->join('pacientes as b','b.id','a.id_paciente')
      ->join('servicios as c','c.id','a.id_servicio')
      ->join('analises as d','d.id','a.id_laboratorio')
      ->join('users as e','e.id','a.origen_usuario')
      ->whereNotIn('a.monto',[0,0.00])
	   ->where('a.es_paquete','<>',1)
      ->where('a.resultado','=', NULL)
      ->where('b.nombres','like','%'.$nom.'%')
      ->where('b.apellidos','like','%'.$ape.'%')
      ->orderby('a.id','desc')
      ->get();


      $informe = Informe::all();

       return view('resultados.index', [
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

    }


