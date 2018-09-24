<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config\Categoria;

class CategoriaController extends Controller
{
	public function index(){
		$categorias = Categoria::all();
		return view('generics.index', [
			"icon" => "fa-list-alt",
			"model" => "categorias",
			"headers" => ["id", "nombre"],
			"data" => $categorias,
			"fields" => ["id", "nombre"],
		]);
	}

}
