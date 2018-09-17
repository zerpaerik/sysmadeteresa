<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laboratorios;

class LaboratoriosController extends Controller
{

	public function index(){
		$laboratorios = Laboratorios::all();
		return view('archivos.laboratorios.index', ["laboratorios" => $laboratorios]);
	}

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'direccion' => 'required|string|max:255',
          'referencia' => 'required|string|max:255' 
        ]);
        if($validator->fails()) 
          return redirect()->action('Archivos\LaboratoriosController@createView', ['errors' => $validator->errors()]);
		$centros = Laboratorios::create([
	      'name' => $request->name,
	      'direccion' => $request->direccion,
	      'referencia' => $request->referencia,
	  
   		]);
		return redirect()->action('Archivos\LaboratoriosController@index', ["created" => true, "centros" => Laboratorios::all()]);
	}    

  public function delete($id){
    $laboratorios = Laboratorios::find($id);
    $laboratorios->delete();
    return redirect()->action('Archivos\LaboratoriosController@index', ["deleted" => true, "laboratorios" => Laboratorios::all()]);
  }

  public function createView() {
    return view('archivos.laboratorios.create');
  }

   public function edit($id) {

   	 $laboratorios = Laboratorios::findOrFail($id);

     return view('archivos.laboratorios.edit', compact('laboratorios'));
    
  }

}
