<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laboratorios;
use Toastr;

class LaboratoriosController extends Controller
{

	 public function index(){

      $laboratorios =Laboratorios::where("estatus", '=', 1)->get();
      return view('archivos.laboratorios.index', [
        "icon" => "fa-list-alt",
        "model" => "laboratorios",
        "headers" => ["id", "Nombre", "Direcciòn", "Referencia", "Editar", "Eliminar"],
        "data" => $laboratorios,
        "fields" => ["id", "name", "direccion", "referencia"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);     
    }

    public function search(Request $request)
    {
      $laboratorios =Laboratorios::where("estatus", '=', 1)
      ->where('name','like','%'.$request->nom.'%')
      ->get();
      return view('archivos.laboratorios.index', [
        "icon" => "fa-list-alt",
        "model" => "laboratorios",
        "headers" => ["id", "Nombre", "Direcciòn", "Referencia", "Editar", "Eliminar"],
        "data" => $laboratorios,
        "fields" => ["id", "name", "direccion", "referencia"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);           
    }

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
         
        ]);
        if($validator->fails()) 
          return redirect()->action('Archivos\LaboratoriosController@createView', ['errors' => $validator->errors()]);
		$centros = Laboratorios::create([
	      'name' => $request->name,
	      'direccion' => $request->direccion,
	      'referencia' => $request->referencia,
	  
   		]);

        Toastr::success('Registrado Exitosamente.', 'Laboratorio!', ['progressBar' => true]);

		return redirect()->action('Archivos\LaboratoriosController@index', ["created" => true, "centros" => Laboratorios::all()]);
	}    

  public function delete($id){
    $laboratorios = Laboratorios::find($id);
    $laboratorios->estatus = 0 ;
    $laboratorios->save();


    return redirect()->action('Archivos\LaboratoriosController@index', ["deleted" => true, "laboratorios" => Laboratorios::all()]);
  }

  public function createView() {
    return view('archivos.laboratorios.create');
  }

   public function editView($id){
      $p = Laboratorios::find($id);
      return view('archivos.laboratorios.edit', ["name" => $p->name, "direccion" => $p->direccion, "referencia" => $p->referencia, "id" => $p->id,]);
      
    }   

      public function edit(Request $request){
      $p = Laboratorios::find($request->id);
      $p->name = $request->name;
      $p->direccion = $request->direccion;
      $p->referencia = $request->referencia;
      $res = $p->save();
      return redirect()->action('Archivos\LaboratoriosController@index', ["edited" => $res]);
    }
}
