<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Servicios;

class ServiciosController extends Controller
{

 public function index(){

      $servicios = Servicios::all();
      return view('generics.index', [
        "icon" => "fa-list-alt",
        "model" => "servicios",
        "headers" => ["id", "Detalle", "Precio", "Eliminar"],
        "data" => $servicios,
        "fields" => ["id", "detalle", "precio",],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  



    }

  

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'detalle' => 'required|string|max:255',
          'precio' => 'required|string|max:20'
        
        ]);
        if($validator->fails()) 
          return redirect()->action('Archivos\ServiciosController@createView', ['errors' => $validator->errors()]);
		$centros = Servicios::create([
	      'detalle' => $request->detalle,
	      'precio' => $request->precio
	     
	  
   		]);
		return redirect()->action('Archivos\ServiciosController@index', ["created" => true, "centros" => Servicios::all()]);
	}    

  public function delete($id){
    $servicios = Servicios::find($id);
    $servicios->delete();
    return redirect()->action('Archivos\ServiciosController@index', ["deleted" => true, "servicios" => Servicios::all()]);
  }

  public function createView() {
  	
    return view('archivos.servicios.create');
  }

   
     public function editView($id){
      $p = Servicios::find($id);
      return view('archivos.servicios.edit', ["detalle" => $p->detalle, "precio" => $p->precio,"id" => $p->id,]);
      
    } 

       public function edit(Request $request){
      $p = Servicios::find($request->id);
      $p->detalle = $request->detalle;
      $p->precio = $request->precio;
      $res = $p->save();
      return redirect()->action('Archivos\ServiciosController@index', ["edited" => $res]);
    }

}
