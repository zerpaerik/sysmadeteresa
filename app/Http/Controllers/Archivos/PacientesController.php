<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pacientes;
use App\Models\EdoCivil;
use App\Models\Provincias;
use App\Models\Distritos;
use App\Models\GradoInstruccion;
use App\Models\HistoriaPacientes;

class PacientesController extends Controller
{

	public function index(){
		$pacientes = Pacientes::all();
		return view('archivos.pacientes.index', ["pacientes" => $pacientes]);
	}

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'nombres' => 'required|string|max:255',
          'apellidos' => 'required|string|max:255'
          
        ]);
        if($validator->fails()) 
          return redirect()->action('Archivos\PacientesController@createView', ['errors' => $validator->errors()]);
		$pacientes = Pacientes::create([
		  'dni' => $request->dni,
	      'nombres' => $request->nombres,
	      'apellidos' => $request->apellidos,
	      'direccion' => $request->direccion,
	      'referencia' => $request->referencia,
	      'fechanac' => $request->fechanac,
	      'edocivil' => $request->edocivil,
	      'provincia' => $request->provincia,
	      'distrito' => $request->distrito,
	      'telefono' => $request->telefono,
	      'referencia' => $request->referencia,
	      'gradoinstruccion' => $request->gradoinstruccion,
	      'ocupacion' => $request->ocupacion,
	      'estatus' => $request->estatus,
	      'historia' => HistoriaPacientes::generarHistoria()
	  
   		]);
		return redirect()->action('Archivos\PacientesController@index', ["created" => true, "pacientes" => Pacientes::all()]);
	}    

  public function delete($id){
    $pacientes = Pacientes::find($id);
    $pacientes->delete();
    return redirect()->action('Archivos\PacientesController@index', ["deleted" => true, "pacientes" => Pacientes::all()]);
  }

  public function createView() {
 
  	$provincias = Provincias::all();
  	$distritos = Distritos::all();
  	$edocivil = EdoCivil::all();
  	$gradoinstruccion = GradoInstruccion::all();
    return view('archivos.pacientes.create', compact('provincias','distritos','edocivil','gradoinstruccion'));
  }

   public function edit($id) {

   	 $pacientes = Pacientes::findOrFail($id);

     return view('archivos.pacientes.edit', compact('pacientes'));
    
  }

}
