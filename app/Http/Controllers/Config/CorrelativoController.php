<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Correlativo;
use DB;
use Toastr;

class CorrelativoController extends Controller
{
  public function create(Request $request){

  	$validator = \Validator::make($request->all(), [
		  'sede' => 'required|unique:correlativos'
          
        ]);
        if($validator->fails()) {
	      Toastr::error('Error Registrando.', 'La Sede ya tiene un Nùmero de Ticket programado!', ['progressBar' => true]);
          return redirect()->action('Config\CorrelativoController@createView', ['errors' => $validator->errors()]);
        } else {
  
  	$correlativo = Correlativo::create([
  		"numero" => $request->numero,
  		"sede" => $request->session()->get('sede')
  	]);

  }

  Toastr::success('Registrado con Exito.', 'Nùmero de Correlativo de Ticket!', ['progressBar' => true]);
    return redirect()->action('Config\CorrelativoController@index', ["created" => true, "correlativo" => Correlativo::all()]);    
  }

  public function index(){

         $correlativo = DB::table('correlativos as a')
                    ->select('a.id','a.numero','a.sede','b.name as nomsede')
                    ->join('sedes as b','b.id','a.sede')
                    ->get(); 

      return view('config.correlativo.index', ["correlativo" => $correlativo]);
  }

  public function createView() {
    return view('config.correlativo.create', ["correlativo" => Correlativo::all()]);
  }  


  public function delete($id){

   $correlativo = Correlativo::find($id);
    $correlativo->delete();
	
     return redirect()->action('Config\CorrelativoController@index', ["created" => true, "correlativo" => Correlativo::all()]);

  }  
}
