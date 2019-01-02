<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config\Proveedor;

class ProveedorController extends Controller
{
	public function index(){
		$proveedores = Proveedor::all();
		return view('config.proveedores.index', ["proveedores" => $proveedores]);
	}

	public function create(Request $request){
		$res = Proveedor::create($request->all());
		return redirect()->action('Config\ProveedorController@index', ["created" => $res]);  
	}

	public function editView($id){
		 $p = Proveedor::find($id);
      return view('config.proveedores.edit', ["id" => $p->id,"nombre" => $p->nombre, "codigo" => $p->codigo,"telefono" => $p->telefono]);
	}

	public function createView(){
		return view('config.proveedores.create');
	}
	
	  public function edit(Request $request){
      $p = Proveedor::find($request->id);
      $p->nombre = $request->nombre;
      $p->codigo = $request->codigo;
	  $p->telefono = $request->telefono;
      $res = $p->save();
      return redirect()->action('Config\ProveedorController@index', ["edited" => $res]);
    }
	
	public function delete($id){
    $proveedor = Proveedor::find($id);
    $proveedor->delete();
	
     return redirect()->action('Config\ProveedorController@index', ["created" => true, "proveedor" => Proveedor::all()]);
	
  }

}
