<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\Producto;
use App\Models\Config\{Medida, Categoria, Sede};


class ProductoController extends Controller
{

    public function index(){
			$producto = Producto::all();
			return view('generics.index', [
				"icon" => "fa-list-alt",
				"model" => "existencias",
				"headers" => ["id", "nombre", "cantidad", "medida", "categoria", "sede_id", "Editar", "Eliminar"],
				"data" => $producto,
				"fields" => ["id", "nombre", "cantidad", "medida", "categoria", "sede_id"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
			]);    	
    }

    public function createView($extraArgs = []){
    	return view('existencias.create', ["medidas" => Medida::all(), "categorias" => Categoria::all()] + $extraArgs);
    }

    public function editView($id){
      $p = Producto::find($id);
      return view('existencias.edit', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad, "id" => $p->id]);
      
    }

    public function productInView(){
      return view('existencias.entrada', ["productos" => Producto::where("sede_id", '=', \Session::get("sede"))->get(['id', 'nombre'])]);  
    }

    public function productOutView(){
      return view('existencias.salida', ["productos" => Producto::where("sede_id", '=', \Session::get("sede"))->get(['id', 'nombre'])]);    
    }

    public function productTransView(){
      $sedes = Sede::whereNotIn("id", [\Session::get('sede')])->get(["id", "name"]);
      return view('existencias.transferir', ["productos" => Producto::where("sede_id", '=', \Session::get("sede"))->get(['id', 'nombre']), "sedes" => $sedes]);    
    }

    public function getProduct($id){
      $p = Producto::find($id);
      return response()->json(["producto" => $p], 200);
    }

    public function addCant(Request $request){
      $p = Producto::find($request->id);
      $p->cantidad = $p->cantidad + $request->cantidadplus;
      $res = $p->save();
      return response()->json(["success" => $res, "producto" => $p], 200);
    }

    public function transfer(Request $request){
      $pfrom = Producto::where('sede_id', '=', \Session::get("sede"))
      ->where("id", '=', $request->id)
      ->get()->first();
      $pfrom->cantidad = $pfrom->cantidad - $request->cantidadplus;
      $wasSubs = $pfrom->save();

      $p = Producto::where('sede_id', '=', $request->sede)
      ->where("nombre", '=', $pfrom->nombre)
      ->get()->first();
      if($wasSubs){
        if($p){
          $p->cantidad = $p->cantidad + $request->cantidadplus;
          $res = $p->save();
          return response()->json(["success" => $res, "producto" => $pfrom, "to" => $p]);
        }else{
          $newprod = Producto::create([
            "nombre" => $pfrom->nombre,
            "categoria" => $pfrom->getOriginal("categoria"),
            "medida" => $pfrom->getOriginal("medida"),
            "cantidad" => $request->cantidadplus,
            "sede_id" => $request->sede
          ]);
          return response()->json(["success" => true, "producto" => $pfrom, "to" => $newprod]);
        }
      }
    }

    public function edit(Request $request){
      $p = Producto::find($request->id);
      $p->nombre = $request->nombre;
      $p->categoria = $request->categoria;
      $p->medida = $request->medida;
      $p->cantidad = $request->cantidad;
      $res = $p->save();
      return redirect()->action('Existencias\ProductoController@index', ["edited" => $res]);
    }

    public function delete($id){
      $p = Producto::find($id);
      $res = $p->delete();
      return response()->json(["deleted" => $res]);
    }

    public function create(Request $request){
	  	$validator = \Validator::make($request->all(), [
	  		"nombre" => "required|unique:productos",
	  		"medida" => "required",
	  		"categoria" => "required"
	  	]);
	  	
    	if($validator->fails()) $this->createView(["created" => false]);
    	$producto = Producto::create([
    		"nombre" => $request->nombre,
    		"categoria" => $request->categoria,
    		"medida" => $request->medida,
    		"cantidad" => $request->cantidad ?: 0,
    		"sede_id" => \Session::get('sede')
    	]);
    	
    	if($producto){
   			return redirect()->action('Existencias\ProductoController@index', ["created" => true]);
			}
   			return redirect()->action('Existencias\ProductoController@index', ["created" => false]);
    }
}
