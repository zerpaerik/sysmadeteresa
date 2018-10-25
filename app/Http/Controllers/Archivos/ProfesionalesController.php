<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profesionales;
use App\Models\Especialidades;
use App\Models\Centros;
use App\User;
use DB;

class ProfesionalesController extends Controller
{

	public function index(){


      	$profesionales = DB::table('profesionales as a')
        ->select('a.id','a.name','a.apellidos','a.dni','a.cmp','a.nacimiento','b.nombre as especialidad','c.name as centro')
        ->join('especialidades as b','a.especialidad','b.id')
        ->join('centros as c','a.centro','c.id')
        ->orderby('a.dni','desc')
        ->paginate(5000);
        return view('generics.index', [
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

	}

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'apellidos' => 'required|string|max:255',
          'cmp' => 'required|string|max:20' ,
          'dni' => 'required|string|max:20' 
        ]);
        if($validator->fails()) 
          return redirect()->action('Archivos\ProfesionalesController@createView', ['errors' => $validator->errors()]);
		$centros = Profesionales::create([
	      'name' => $request->name,
	      'apellidos' => $request->apellidos,
	      'cmp' => $request->cmp,
	      'dni' => $request->dni,
	      'nacimiento' => $request->nacimiento,
	      'especialidad' => $request->especialidad,
	      'centro' => $request->centro

   		]);

      $users= User::create([
        'name' => $request->name,
        'lastname' => $request->apellidos,
        'tipo' => '2',
        'dni' => $request->dni

      ]);

		return redirect()->action('Archivos\ProfesionalesController@index', ["created" => true, "centros" => Profesionales::all()]);
	}    

  public function delete($id){
    $centros = Profesionales::find($id);
    $centros->delete();
    return redirect()->action('Archivos\ProfesionalesController@index', ["deleted" => true, "users" => Centros::all()]);
  }

  public function createView() {

    $centros = Centros::all();
    $especialidades = Especialidades::all();

    return view('archivos.profesionales.create', compact('centros','especialidades'));
  }

     public function editView($id){
      $p = Profesionales::find($id);
      return view('archivos.profesionales.edit', ["especialidades" => Especialidades::all(),"centros" => Centros::all(),"name" => $p->name, "apellidos" => $p->apellidos,"cmp" => $p->cmp,"dni" => $p->dni, "nacimiento" => $p->nacimiento,"id" => $p->id]);
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
      $res = $p->save();
      return redirect()->action('Archivos\ProfesionalesController@index', ["edited" => $res]);
    }

}
