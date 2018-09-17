<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config\Medida;

class MedidaController extends Controller
{

	public function index(){
		$medidas = Medida::all();
		return view('generics.index', [
			"icon" => "fa-dropbox",
			"model" => "medidas",
			"headers" => ["id", "nombre"],
			"data" => $medidas,
			"fields" => ["id", "nombre"],
		]);
	}

    public function create(Request $request){
    	
    }
}
