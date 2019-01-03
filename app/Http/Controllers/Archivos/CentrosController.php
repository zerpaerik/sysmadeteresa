<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Centros;
use App\Models\Historiales;
use Toastr;
use DB;
use Auth;

class CentrosController extends Controller
{

	/*public function index(){
		$centros = Centros::all();
		return view('archivos.centros.index', ["centros" => $centros]);
	}*/

   public function index(){

      ///$centros =Centros::where("estatus", '=', 1)->get();
	   $centros = DB::table('centros as a')
        ->select('a.id','a.name','a.direccion','a.referencia','a.usuario','c.name as user','c.lastname')
		->join('users as c','c.id','a.usuario')
        ->where('a.estatus','=', 1)
        ->get();  
		
      return view('archivos.centros.index', ['centros' => $centros]);     
    }

    public function  show(Request $request)
    {
      $centros =Centros::where("name", 'like', '%'.$request->nom.'%')->get();
      return view('archivos.centros.index', [
        "icon" => "fa-list-alt",
        "model" => "centros",
        "headers" => ["id", "Nombre", "Direcciòn", "Referencia", "Editar", "Eliminar"],
        "data" => $centros,
        "fields" => ["id", "name", "direccion", "referencia"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);        
    }

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          
        ]);
        if($validator->fails()) 
          return redirect()->action('Archivos\CentrosController@createView', ['errors' => $validator->errors()]);
		$centros = Centros::create([
	      'name' => $request->name,
	      'direccion' => $request->direccion,
	      'referencia' => $request->referencia,
		  'usuario' => 	Auth::user()->id

	  
   		]);
		
		  $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Centro Mèdico';
		  $historial->detalle =$request->name;
          $historial->id_usuario = \Auth::user()->id;
		  $historial->sede = $request->session()->get('sede');
          $historial->save();

        Toastr::success('Registrado Exitosamente.', 'Centro Mèdico!', ['progressBar' => true]);

		return redirect()->action('Archivos\CentrosController@index', ["created" => true, "centros" => Centros::all()]);
	}  

    public function editView($id){
      $p = Centros::find($id);
      return view('archivos.centros.edit', ["name" => $p->name, "direccion" => $p->direccion, "referencia" => $p->referencia, "id" => $p->id,]);
      
    }   

      public function edit(Request $request){
      $p = Centros::find($request->id);
      $p->name = $request->name;
      $p->direccion = $request->direccion;
      $p->referencia = $request->referencia;
      $res = $p->save();
      return redirect()->action('Archivos\CentrosController@index', ["edited" => $res]);
    }

  public function delete($id){
    $centros = Centros::find($id);
    $centros->estatus = 0;
    $centros->save();
    return redirect()->action('Archivos\CentrosController@index', ["deleted" => true, "users" => Centros::all()]);
  }

  public function createView() {
    return view('archivos.centros.create');
  }



}
