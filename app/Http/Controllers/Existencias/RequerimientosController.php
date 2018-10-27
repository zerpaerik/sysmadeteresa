<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Requerimientos, Transferencia};
use App\Models\Config\{Sede, Proveedor};
use Illuminate\Support\Facades\Auth;
use DB;


class RequerimientosController extends Controller
{

    public function index(){

      $requerimientos = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.descripcion','a.estatus','b.name as sede','a.created_at','c.name as solicitante')
                    ->join('sedes as b','a.id_sede_solicitada','b.id')
                    ->join('users as c','c.id','a.usuario')
                    ->where('a.id_sede_solicita', '=', \Session::get("sede"))
                    ->get();  

			return view('existencias.requerimientos.index',compact('requerimientos'));   	
    }

     public function index2(){

      $requerimientos2 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.descripcion','a.estatus','b.name as sede','a.created_at','c.name as solicitante')
                    ->join('sedes as b','a.id_sede_solicita','b.id')
                    ->join('users as c','c.id','a.usuario')
                    ->where('a.id_sede_solicitada', '=', \Session::get("sede"))
                    ->get();  

			return view('existencias.requerimientos.index2',compact('requerimientos2'));   	
    }



    public function createView(){
    	return view('existencias.requerimientos.create', ["sedes" => Sede::whereNotIn("id", [\Session::get('sede')])->get(["id", "name"])]);
    }


    public function create(Request $request){

        $id_usuario = Auth::id();

	  	$validator = \Validator::make($request->all(), [
	  		"id_sede_solicitada" => "required",
	  		"descripcion" => "required"
	  	]);
	  	
    	if($validator->fails()) $this->createView(["created" => false]);
    	$requerimiento = Requerimientos::create([
    		"id_sede_solicitada" => $request->id_sede_solicitada,
    		"descripcion" => $request->descripcion,
    		"usuario" => $id_usuario,
            "id_sede_solicita" => $request->session()->get('sede'),
            "estatus" => 'Solicitado'
    	]);
    	
    	if($requerimiento){
   			return redirect()->action('Existencias\RequerimientosController@index', ["created" => true]);
			}
   			return redirect()->action('Existencias\RequerimientosController@index', ["created" => false]);
    }

     public function editView($id){
      $p = Requerimientos::find($id);
      return view('existencias.requerimientos.edit', ["sedes" => Sede::whereNotIn("id", [\Session::get('sede')])->get(["id", "name"]),"descripcion" => $p->descripcion, "estatus" => $p->estatus,"id_sede_solicitada" => $p->id_sede_solicitada,"id" => $p->id]);
    }

      public function procesar($id, Request $request){

      $p = Requerimientos::find($request->id);
      $p->estatus = 'Procesado';
      $res = $p->save();

      return redirect()->action('Existencias\RequerimientosController@index2', ["edited" => $res]);
    }

       
}
