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
			"headers" => ["id", "nombre", "codigo"],
			"data" => $proveedores,
			"fields" => ["id", "nombre", "codigo"],
		]);
	}

}
