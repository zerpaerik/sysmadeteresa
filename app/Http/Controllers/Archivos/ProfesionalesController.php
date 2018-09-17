<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profesionales;
use App\Models\Especialidades;
use App\Models\Centros;
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

		return view('archivos.profesionales.index', ["profesionales" => $profesionales]);
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

   public function edit($id) {

   	 $profesionales = Profesionales::findOrFail($id);

     return view('archivos.profesionales.edit', compact('profesionales'));
    
  }

}
