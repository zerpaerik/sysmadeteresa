<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\Producto;
use App\Models\Config\{Medida, Categoria};


class ProductoController extends Controller
{
    public function index(){
			$producto = Producto::all();
			return view('generics.index', [
				"icon" => "fa-list-alt",
				"model" => "existencias",
				"headers" => ["id", "nombre", "cantidad", "medida", "categoria", "sede_id"],
				"data" => $producto,
				"fields" => ["id", "nombre", "cantidad", "medida", "categoria", "sede_id"],
			]);    	
    }

    public function createView($extraArgs = []){
    	return view('existencias.create', ["medidas" => Medida::all(), "categorias" => Categoria::all()] + $extraArgs);
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
   			return redirect()->action('Existencias\ProductoController@index', ["created" => true, "pacientes" => Producto::all()]);
			}
   			return redirect()->action('Existencias\ProductoController@index', ["created" => false, "pacientes" => Producto::all()]);
    }
}
