<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profesionales;
use App\Models\Especialidades;
use App\Models\Centros;
use App\Models\Historiales;
use App\User;
use DB;
use Toastr;
use Auth;

class ProfesionalesController extends Controller
{

	public function index(){


      	$profesionales = DB::table('profesionales as a')
        ->select('a.id','a.name','a.apellidos','a.dni','a.cmp','a.estatus','a.nacimiento','b.nombre as especialidad','c.name as centro','d.name as user','d.lastname','e.id as codigo')
        ->join('especialidades as b','a.especialidad','b.id')
        ->join('centros as c','a.centro','c.id')
	    	->join('users as d','d.id','a.usuario')
        ->join('users as e','e.lastname','a.apellidos')
	    	->orderBy('a.id')
        ->where('a.estatus','=', 1)
        ->groupBy('a.apellidos')
        //->orderby('a.dni','desc')
        ->get();
        return view('archivos.profesionales.index', ['profesionales' => $profesionales]);  

	}

  public function search(Request $request)
  {
      $search = $request->nom;
      $split = explode(" ",$search);
      
      if (!isset($split[1])) {

        $split[1] = '';
        $personal = $profesionales = DB::table('profesionales as a')
        ->select('a.id','a.name','a.apellidos','a.dni','a.cmp','a.estatus','a.nacimiento','b.nombre as especialidad','c.name as centro')
        ->join('especialidades as b','a.especialidad','b.id')
        ->join('centros as c','a.centro','c.id')
        ->where('a.estatus','=', 1)
        ->where('a.name','like', '%'.$split[0].'%')
        ->where('a.apellidos','like', '%'.$split[1].'%')
        ->orderby('a.id')
        ->get();
        return view('archivos.profesionales.index', [
        "icon" => "fa-list-alt",
        "model" => "profesionales",
        "headers" => ["id", "Nombre", "Apellidos", "DNI", "Especialidad", "Centro", "Editar", "Eliminar"],
        "data" => $profesionales,
        "fields" => ["id", "name", "apellidos", "dni", "especialidad", "centro"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  

      }else{
        $profesionales = DB::table('profesionales as a')
        ->select('a.id','a.name','a.apellidos','a.dni','a.cmp','a.usuario','a.estatus','a.nacimiento','b.nombre as especialidad','c.name as centro','d.name as user','d.lastname')
        ->join('especialidades as b','a.especialidad','b.id')
        ->join('centros as c','a.centro','c.id')
		->join('users as d','d.id','a.usuario')
        ->where('a.estatus','=', 1)
        ->where('a.name','like', '%'.$split[0].'%')
        ->where('a.name','like', '%'.$split[1].'%')
        ->orderby('a.dni','desc')
        ->get();
        return view('archivos.profesionales.index', [
        "icon" => "fa-list-alt",
        "model" => "profesionales",
        "headers" => ["id", "Nombre", "Apellidos", "DNI", "Especialidad", "Centro","Registrado Por:", "Editar", "Eliminar"],
        "data" => $profesionales,
        "fields" => ["id", "name", "apellidos", "dni", "especialidad", "centro","user"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  
      }    
  }

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          
        ]);
        if($validator->fails()) {
	      Toastr::error('Error Registrando.', 'Profesional- DNI YA REGISTRADO!', ['progressBar' => true]);
          return redirect()->action('Archivos\ProfesionalesController@createView', ['errors' => $validator->errors()]);
		} else {
		$centros = Profesionales::create([
	      'name' => $request->name,
	      'apellidos' => $request->apellidos,
	      'cmp' => $request->cmp,
	      'dni' => $request->dni,
	      'nacimiento' => $request->nacimiento,
	      'especialidad' => $request->especialidad,
	      'centro' => $request->centro,
          'phone' => $request->phone,
		  'usuario' => 	Auth::user()->id,
   		]);

      $users= User::create([
        'name' => $request->name,
        'lastname' => $request->apellidos,
        'tipo' => 2,
        'dni' => $request->dni

      ]);
	  
	      $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Profesional de Apoyo';
		  $historial->detalle = $request->dni;
          $historial->id_usuario = \Auth::user()->id;
		  $historial->sede = $request->session()->get('sede');
          $historial->save();
          

     Toastr::success('Registrado Exitosamente.', 'Profesional de Apoyo!', ['progressBar' => true]);

		return redirect()->action('Archivos\ProfesionalesController@index', ["created" => true, "centros" => Profesionales::all()]);
		}
	}

  public function delete($id){
    $centros = Profesionales::find($id);
    $centros->estatus= 0;
    $centros->save();
    return redirect()->action('Archivos\ProfesionalesController@index', ["deleted" => true, "users" => Centros::all()]);
  }

  public function createView() {

    $centros =Centros::where("estatus", '=', 1)->get();
    $especialidades = Especialidades::all();

    return view('archivos.profesionales.create', compact('centros','especialidades'));
  }

     public function editView($id){
      $p = Profesionales::find($id);
      $u = User::where('dni',$p->dni)->first();
      return view('archivos.profesionales.edit', ["especialidades" => Especialidades::all(),"centros" => Centros::all(),"name" => $p->name, "apellidos" => $p->apellidos,"cmp" => $p->cmp,"dni" => $p->dni, "nacimiento" => $p->nacimiento,"phone" => $p->phone,"id" => $p->id, "tipo" => $u->tipo]);
    }

     public function edit(Request $request){
      $p = Profesionales::find($request->id);
      $p->name = $request->name;
      $p->apellidos = $request->apellidos;
      $p->dni = $request->dni;
      $p->cmp = $request->cmp;
      $p->especialidad = $request->especialidad;
      $p->centro = $request->centro;
      $p->nacimiento = $request->nacimiento;
      $p->phone = $request->phone;
      $res = $p->save();
      User::where('dni', $request->dni)
          ->update([
            "tipo" => $request->tipo
          ]);
      return redirect()->action('Archivos\ProfesionalesController@index', ["edited" => $res]);
    }

}
