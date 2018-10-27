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
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.cantidad','a.estatus','b.name as sede','a.created_at','c.name as solicitante','d.nombre')
                    ->join('sedes as b','a.id_sede_solicitada','b.id')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->where('a.id_sede_solicita', '=', \Session::get("sede"))
                    ->get();  

			return view('existencias.requerimientos.index',compact('requerimientos'));   	
    }

     public function index2(){

      $requerimientos2 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.cantidad','a.estatus','b.name as sede','a.created_at','c.name as solicitante','d.nombre')
                    ->join('sedes as b','a.id_sede_solicita','b.id')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->where('a.id_sede_solicitada', '=', \Session::get("sede"))
                    ->get();  

			return view('existencias.requerimientos.index2',compact('requerimientos2'));   	
    }



    public function createView(){
    	return view('existencias.requerimientos.create', ["productos" => Producto::where('sede_id','=', 1)->get(["id", "nombre"])]);
    }


    public function create(Request $request){

   
    if (isset($request->id_laboratorio)) {
      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {
          $lab = new Requerimientos();
          $lab->id_producto =  $laboratorio['laboratorio'];
          $lab->cantidad =  $request->monto_abol['laboratorios'][$key]['abono'];;
          $lab->id_sede_solicita = $request->session()->get('sede');
          $lab->usuario = 1;
          $lab->id_sede_solicitada = 1;
          $lab->estatus = 'Solicitado';
          $lab->save();

        } 
      }
    }

    return redirect()->route('requerimientos.index');

    }

    

      public function procesar($id, Request $request){

      $p = Requerimientos::find($request->id);
      $p->estatus = 'Procesado';
      $res = $p->save();

      return redirect()->action('Existencias\RequerimientosController@index2', ["edited" => $res]);
    }

       
}
