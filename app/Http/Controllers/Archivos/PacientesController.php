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
use Carbon\Carbon;
class PacientesController extends Controller
{

	
  public function index(){

      $pacientes =Pacientes::where("estatus", '=', 1)->get();
      return view('generics.index', [
        "icon" => "fa-list-alt",
        "model" => "pacientes",
        "headers" => ["id", "Nombre", "Apellido", "DNI", "Telèfono", "Direcciòn", "Editar", "Eliminar"],
        "data" => $pacientes,
        "fields" => ["id", "nombres", "apellidos", "dni", "telefono", "direccion"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  
  }

  public function search(Request $request){

      $search = $request->nom;
      $split = explode(" ",$search);
      
      if (!isset($split[1])) {
      
      $split[1] = '';
      $pacientes =Pacientes::where("estatus", '=', 1)
      ->where('nombres','like','%'.$split[0].'%')
      ->where('apellidos','like','%'.$split[1].'%')
      ->get();
      return view('generics.index', [
        "icon" => "fa-list-alt",
        "model" => "pacientes",
        "headers" => ["id", "Nombre", "Apellido", "DNI", "Telèfono", "Direcciòn", "Editar", "Eliminar"],
        "data" => $pacientes,
        "fields" => ["id", "nombres", "apellidos", "dni", "telefono", "direccion"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]); 

      }else{

      $pacientes =Pacientes::where("estatus", '=', 1)
      ->where('nombres','like','%'.$split[0].'%')
      ->where('apellidos','like','%'.$split[1].'%')
      ->get();
      return view('generics.index', [
        "icon" => "fa-list-alt",
        "model" => "pacientes",
        "headers" => ["id", "Nombre", "Apellido", "DNI", "Telèfono", "Direcciòn", "Editar", "Eliminar"],
        "data" => $pacientes,
        "fields" => ["id", "nombres", "apellidos", "dni", "telefono", "direccion"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  
     }     
     
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
	      'estatus' => 1,
	      'historia' => HistoriaPacientes::generarHistoria()
	  
   		]);
		return redirect()->action('Archivos\PacientesController@index', ["created" => true, "pacientes" => Pacientes::all()]);
	}   

    public function create2(Request $request){
        
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
        'estatus' => 1,
        'historia' => HistoriaPacientes::generarHistoria()
    
      ]);

    return redirect()->route('atenciones.create');
   // return redirect()->action('Archivos\PacientesController@index', ["created" => true, "pacientes" => Pacientes::all()]);
  }   

  public function delete($id){
    $pacientes = Pacientes::find($id);
    $pacientes->estatus= 0;
    $pacientes->save();
    return redirect()->action('Archivos\PacientesController@index', ["deleted" => true, "pacientes" => Pacientes::all()]);
  }

  public function createView() {
 
  	$provincias = Provincias::all();
  	$distritos = Distritos::all();
  	$edocivil = EdoCivil::all();
  	$gradoinstruccion = GradoInstruccion::all();
    return view('archivos.pacientes.create', compact('provincias','distritos','edocivil','gradoinstruccion'));
  }

    public function createView2() {
 
    $provincias = Provincias::all();
    $distritos = Distritos::all();
    $edocivil = EdoCivil::all();
    $gradoinstruccion = GradoInstruccion::all();
    return view('archivos.pacientes.create2', compact('provincias','distritos','edocivil','gradoinstruccion'));
  }

   public function createpac() {
 
    $provincias = Provincias::all();
    $distritos = Distritos::all();
    $edocivil = EdoCivil::all();
    $gradoinstruccion = GradoInstruccion::all();
    return view('archivos.pacientes.createpac', compact('provincias','distritos','edocivil','gradoinstruccion'));
  }

  public function editView($id){
      $p = Pacientes::find($id);
      return view('archivos.pacientes.edit', ["provincias" => Provincias::all(),"distritos" => Distritos::all(),"edocivil" => EdoCivil::all(),"gradoinstruccion" => GradoInstruccion::all(),"dni" => $p->dni, "nombres" => $p->nombres,"apellidos" => $p->apellidos,"direccion" => $p->direccion,"fechanac" => $p->fechanac,"gradoinstruccions" => $p->gradoinstruccions,"ocupacion" => $p->ocupacion,"historia" => $p->historia,"telefono" => $p->telefono,"referencia" => $p->referencia,"provincia" => $p->provincia,"distrito" => $p->distrito,"id" => $p->id]);
    }


  public function edit(Request $request){
      $p = Pacientes::find($request->id);
      $p->dni = $request->dni;
      $p->nombres = $request->nombres;
      $p->apellidos = $request->apellidos;
      $p->direccion = $request->direccion;
      $p->telefono = $request->telefono;
      $p->fechanac = $request->fechanac;
      $p->ocupacion = $request->ocupacion;
      $p->gradoinstruccion = $request->gradoinstruccion;
      $res = $p->save();
      return redirect()->action('Archivos\PacientesController@index', ["edited" => $res]);
    }

}
