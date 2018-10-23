<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config\Proveedor;

class ProveedorController extends Controller
{
	public function index(){
		$proveedores = Proveedor::all();
		return view('generics.index', [
			"icon" => "fa-truck",
			"model" => "proveedores",
			"headers" => ["id", "nombre", "codigo", "editar", "eliminar"],
			"data" => $proveedores,
			"fields" => ["id", "nombre", "codigo"],
		]);
	}

	public function create(Request $request){
		$res = Proveedor::create($request->all());
		return redirect()->action('Config\ProveedorController@index', ["created" => $res]);  
	}

	public function editView(){
		return view('config.proveedores.edit');
	}

	public function createView(){
		return view('config.proveedores.create');
	}

}
