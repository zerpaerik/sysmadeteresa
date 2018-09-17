<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Servicios;

class ServiciosController extends Controller
{

	public function index(){
		$servicios = Servicios::all();
		return view('archivos.servicios.index', ["servicios" => $servicios]);
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

   public function edit($id) {

   	 $servicios = Servicios::findOrFail($id);

     return view('archivos.servicios.edit', compact('servicios'));
    
  }

}
