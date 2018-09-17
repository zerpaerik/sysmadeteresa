<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Centros;

class CentrosController extends Controller
{

	public function index(){
		$centros = Centros::all();
		return view('archivos.centros.index', ["centros" => $centros]);
	}

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'direccion' => 'required|string|max:255',
          'referencia' => 'required|string|max:255' 
        ]);
        if($validator->fails()) 
          return redirect()->action('Archivos\CentrosController@createView', ['errors' => $validator->errors()]);
		$centros = Centros::create([
	      'name' => $request->name,
	      'direccion' => $request->direccion,
	      'referencia' => $request->referencia,
	  
   		]);
		return redirect()->action('Archivos\CentrosController@index', ["created" => true, "centros" => Centros::all()]);
	}    

  public function delete($id){
    $centros = Centros::find($id);
    $centros->delete();
    return redirect()->action('Archivos\CentrosController@index', ["deleted" => true, "users" => Centros::all()]);
  }

  public function createView() {
    return view('archivos.centros.create');
  }

   public function edit($id) {

   	 $centros = Centros::findOrFail($id);

     return view('archivos.centros.edit', compact('centros'));
    
  }

}
