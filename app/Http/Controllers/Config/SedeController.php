<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config\Sede;

class SedeController extends Controller
{
  public function create(Request $request){
  	$validator = \Validator::make($request->all(), [
  		"name" => "required|unique:sedes",
  		"address" => "required"
  	]);
  	$sede = Sede::create([
  		"name" => $request->name,
  		"address" => $request->address
  	]);

    return redirect()->action('Config\SedeController@index', ["created" => true, "sedes" => Sede::all()]);    
  }

  public function index(){
      $sedes = Sede::all();
      return view('config.sedes.index', ["sedes" => $sedes]);
  }

  public function createView() {
    return view('config.sedes.create', ["sedes" => Sede::all()]);
  }    
}
