<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Analisis;
use App\Models\Laboratorios;
use DB;
use Toastr;

class AnalisisController extends Controller
{

	public function index(){


	$analisis = DB::table('analises as a')
        ->select('a.id','a.name','a.preciopublico','a.costlab','a.estatus','a.costlab','a.tiempo','a.material','b.name as laboratorio')
        ->join('laboratorios as b','a.laboratorio','b.id')
        ->orderby('a.id','desc')
        ->where('a.estatus','=', 1)
        ->paginate(5000);     
        return view('generics.index', [
        "icon" => "fa-list-alt",
        "model" => "analisis",
        "headers" => ["Nombre", "Precio al Pùblico", "Costo", "Tiempo", "Material","Laboratorio", "Editar", "Eliminar"],
        "data" => $analisis,
        "fields" => [ "name", "preciopublico", "costlab", "tiempo", "material","laboratorio"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  
	}

  public function search(Request $request)
  {
    $analisis = DB::table('analises as a')
          ->select('a.id','a.name','a.preciopublico','a.costlab','a.estatus','a.costlab','a.tiempo','a.material','b.name as laboratorio')
          ->join('laboratorios as b','a.laboratorio','b.id')
          ->orderby('a.id','desc')
          ->where('a.estatus','=', 1)
          ->where('a.name','like', '%'.$request->nom.'%')
          ->paginate(5000);     
          return view('generics.index', [
          "icon" => "fa-list-alt",
          "model" => "analisis",
          "headers" => ["Nombre", "Precio al Pùblico", "Costo", "Tiempo", "Material","Laboratorio", "Editar", "Eliminar"],
          "data" => $analisis,
          "fields" => [ "name", "preciopublico", "costlab", "tiempo", "material","laboratorio"],
            "actions" => [
              '<button type="button" class="btn btn-info">Transferir</button>',
              '<button type="button" class="btn btn-warning">Editar</button>'
            ]
        ]);  
  }

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'preciopublico' => 'required|string|max:255',
          'costlab' => 'required|string|max:20' 
        ]);
        if($validator->fails()) 
          return redirect()->action('Archivos\AnalisisController@createView', ['errors' => $validator->errors()]);
		$analisis = Analisis::create([
	      'name' => $request->name,
	      'preciopublico' => $request->preciopublico,
	      'costlab' => $request->costlab,
	      'laboratorio' => $request->laboratorio,
        'porcentaje' => $request->porcentaje,
	      'tiempo' => $request->tiempo,
	      'material' => $request->material
	    

   		]);
            Toastr::success('Registrado Exitosamente.', 'Analisis de Laboratorio!', ['progressBar' => true]);

		return redirect()->action('Archivos\AnalisisController@index', ["created" => true, "analisis" => Analisis::all()]);
	}    

  public function delete($id){
    $analisis = Analisis::find($id);
    $analisis->estatus = 0;
    $analisis->save();
    return redirect()->action('Archivos\AnalisisController@index', ["deleted" => true, "analisis" => Analisis::all()]);
  }

  public function createView() {

    $laboratorios = Laboratorios::all();

    return view('archivos.analisis.create', compact('laboratorios'));
  }

    public function editView($id){
      $p = Analisis::find($id);
      return view('archivos.analisis.edit', ["laboratorios" => Laboratorios::all(),"name" => $p->name, "preciopublico" => $p->preciopublico,"costlab" => $p->costlab,"tiempo" => $p->tiempo, "laboratorio" => $p->laboratorio,"porcentaje" => $p->porcentaje, "material" => $p->material,"id" => $p->id]);
    }

      public function edit(Request $request){
      $p = Analisis::find($request->id);
      $p->name = $request->name;
      $p->preciopublico = $request->preciopublico;
      $p->costlab = $request->costlab;
      $p->laboratorio = $request->laboratorio;
      $p->tiempo = $request->tiempo;
      $p->material = $request->material;
      $p->porcentaje = $request->porcentaje;
      $res = $p->save();
      return redirect()->action('Archivos\AnalisisController@index', ["edited" => $res]);
    }

  public function getAnalisi($id)
  {
    return Analisis::findOrFail($id);
  }
}
