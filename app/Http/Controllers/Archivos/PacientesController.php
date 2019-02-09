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
use App\Models\Historiales;
use Carbon\Carbon;
use Auth;
use DB;
use Toastr;
class PacientesController extends Controller
{

	
  public function index(){

     // $pacientes =Pacientes::where("estatus", '=', 1)->get();
	  
	  $pacientes = DB::table('pacientes as a')
        ->select('a.id','a.nombres','a.apellidos','a.direccion','a.provincia','a.dni','a.telefono','a.fechanac','a.historia','a.ocupacion','a.usuario','c.name as user','c.lastname')
		    ->join('users as c','c.id','a.usuario')
        ->where('a.estatus','=', 1)
        ->get(); 

      
	  
      return view('archivos.pacientes.index', ['pacientes' => $pacientes]);  
  }



   public function indexr(Request $request){

     // $pacientes =Pacientes::where("estatus", '=', 1)->get();
    
    $pacientes = DB::table('pacientes as a')
        ->select('a.id','a.nombres','a.apellidos','a.direccion','a.provincia','a.dni','a.telefono','a.fechanac','a.historia','a.ocupacion','a.usuario','c.name as user','c.lastname')
        ->join('users as c','c.id','a.usuario')
        ->where('a.estatus','=', 1)
        ->get(); 

      
    
      return view('archivos.pacientes.reporte', ['pacientes' => $pacientes]);  
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
  

     public function show($id)
    {
	  
	   $pacientes = DB::table('pacientes as a')
              
			  ->select('a.id','a.nombres','a.apellidos','a.dni','a.historia','a.direccion','a.gradoinstruccion','a.telefono','a.fechanac','a.ocupacion','a.distrito','b.nombre')
              ->join('distritos as b','b.id','a.distrito')
			  ->where('a.id','=', $id)
              ->first();
	  
      return view('archivos.pacientes.show', compact('pacientes'));
    }	  

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'nombres' => 'required|string|max:255',
          'apellidos' => 'required|string|max:255',
		      'dni' => 'required|unique:pacientes'
          
        ]);
        if($validator->fails()) {
	      Toastr::error('Error Registrando.', 'Paciente- DNI YA REGISTRADO!', ['progressBar' => true]);
          return redirect()->action('Archivos\PacientesController@createView', ['errors' => $validator->errors()]);
        } else {
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
		    'usuario' => 	Auth::user()->id,
	      'historia' => HistoriaPacientes::generarHistoria()
	  
   		]);
		
		  $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Paciente';
		  $historial->detalle =$request->dni;
          $historial->id_usuario = \Auth::user()->id;
		  $historial->sede = $request->session()->get('sede');
          $historial->save();
		  }
		Toastr::success('Registrado Exitosamente.', 'Paciente!', ['progressBar' => true]);
		return redirect()->action('Archivos\PacientesController@index', ["created" => true, "pacientes" => Pacientes::all()]);
	}   

    public function create2(Request $request){


       $validator = \Validator::make($request->all(), [
          'nombres' => 'required|string|max:255',
          'apellidos' => 'required|string|max:255',
          'dni' => 'required|unique:pacientes'
          
        ]);
        if($validator->fails()) {
        Toastr::error('Error Registrando.', 'Paciente- DNI YA REGISTRADO!', ['progressBar' => true]);
          return redirect()->action('Archivos\PacientesController@createView2', ['errors' => $validator->errors()]);
        } else {
        
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
        'usuario' =>  Auth::user()->id,
        'historia' => HistoriaPacientes::generarHistoria()
    
      ]);
	  
	     $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Paciente';
		  $historial->detalle =$request->dni;
          $historial->id_usuario = \Auth::user()->id;
          $historial->save();

      }
    Toastr::success('Registrado Exitosamente.', 'Paciente!', ['progressBar' => true]);
    return redirect()->route('atenciones.create');

   // return redirect()->action('Archivos\PacientesController@index', ["created" => true, "pacientes" => Pacientes::all()]);
  }  

   public function create3(Request $request){

     $validator = \Validator::make($request->all(), [
          'nombres' => 'required|string|max:255',
          'apellidos' => 'required|string|max:255',
          'dni' => 'required|unique:pacientes'
          
        ]);
        if($validator->fails()) {
        Toastr::error('Error Registrando.', 'Paciente- DNI YA REGISTRADO!', ['progressBar' => true]);
          return redirect()->action('Archivos\PacientesController@createView3', ['errors' => $validator->errors()]);
        } else {
        
        
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
        'usuario' =>  Auth::user()->id,
        'historia' => HistoriaPacientes::generarHistoria()
    
      ]);
    
       $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Paciente';
      $historial->detalle =$request->dni;
          $historial->id_usuario = \Auth::user()->id;
          $historial->save();

     }
    Toastr::success('Registrado Exitosamente.', 'Paciente!', ['progressBar' => true]);
    return redirect()->route('consultas.create');

   // return redirect()->action('Archivos\PacientesController@index', ["created" => true, "pacientes" => Pacientes::all()]);
  }    

     public function create4(Request $request){

     $validator = \Validator::make($request->all(), [
          'nombres' => 'required|string|max:255',
          'apellidos' => 'required|string|max:255',
          'dni' => 'required|unique:pacientes'
          
        ]);
        if($validator->fails()) {
        Toastr::error('Error Registrando.', 'Paciente- DNI YA REGISTRADO!', ['progressBar' => true]);
          return redirect()->action('Archivos\PacientesController@createView3', ['errors' => $validator->errors()]);
        } else {
        
        
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
        'usuario' =>  Auth::user()->id,
        'historia' => HistoriaPacientes::generarHistoria()
    
      ]);
    
       $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Paciente';
      $historial->detalle =$request->dni;
          $historial->id_usuario = \Auth::user()->id;
          $historial->save();

     }
    Toastr::success('Registrado Exitosamente.', 'Paciente!', ['progressBar' => true]);
    return redirect()->route('metodos.create');

   // return redirect()->action('Archivos\PacientesController@index', ["created" => true, "pacientes" => Pacientes::all()]);
  }   

  public function delete($id){
    $pacientes = Pacientes::find($id);
    $pacientes->estatus= 0;
    $pacientes->save();
    return redirect()->action('Archivos\PacientesController@index', ["deleted" => true, "pacientes" => Pacientes::all()]);
  }

  public function createView() {

    $provincias =Provincias::orderBy('nombre','asc')->get();
    $distritos =Distritos::orderBy('nombre','asc')->get();
  	$edocivil = EdoCivil::all();
  	$gradoinstruccion = GradoInstruccion::all();
    return view('archivos.pacientes.create', compact('provincias','distritos','edocivil','gradoinstruccion'));
  }

    public function createView2() {
 
     $provincias =Provincias::orderBy('nombre','asc')->get();
    $distritos =Distritos::orderBy('nombre','asc')->get();
    $edocivil = EdoCivil::all();
    $gradoinstruccion = GradoInstruccion::all();
    return view('archivos.pacientes.create2', compact('provincias','distritos','edocivil','gradoinstruccion'));
  }

    public function createView3() {
 
     $provincias =Provincias::orderBy('nombre','asc')->get();
    $distritos =Distritos::orderBy('nombre','asc')->get();
    $edocivil = EdoCivil::all();
    $gradoinstruccion = GradoInstruccion::all();
    return view('archivos.pacientes.create3', compact('provincias','distritos','edocivil','gradoinstruccion'));
  }

  public function createView4() {
 
    $provincias =Provincias::orderBy('nombre','asc')->get();
    $distritos =Distritos::orderBy('nombre','asc')->get();
    $edocivil = EdoCivil::all();
    $gradoinstruccion = GradoInstruccion::all();
    return view('archivos.pacientes.create4', compact('provincias','distritos','edocivil','gradoinstruccion'));
  }


   public function createpac() {
 
     $provincias =Provincias::orderBy('nombre','asc')->get();
    $distritos =Distritos::orderBy('nombre','asc')->get();
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
