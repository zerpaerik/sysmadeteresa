<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Analisis;
use App\Models\Laboratorios;
use DB;

class AnalisisController extends Controller
{

	public function index(){


	$analisis = DB::table('analises as a')
        ->select('a.id','a.name','a.preciopublico','a.costlab','a.tiempo','a.material','b.name as laboratorio')
        ->join('laboratorios as b','a.laboratorio','b.id')
        ->orderby('a.id','desc')
        ->paginate(5000);

		return view('archivos.analisis.index', ["analisis" => $analisis]);
	}

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'preciopublico' => 'required|string|max:255',
          'costlab' => 'required|string|max:20' 
        ]);
        if($validator->fails()) 
          return redirect()->action('Archivos\AnalisisController@createView', ['errors' => $validator->errors()]);
		$analisis = Analisis::create([
	      'name' => $request->name,
	      'preciopublico' => $request->preciopublico,
	      'costlab' => $request->costlab,
	      'laboratorio' => $request->laboratorio,
	      'tiempo' => $request->tiempo,
	      'material' => $request->material
	    

   		]);
		return redirect()->action('Archivos\AnalisisController@index', ["created" => true, "analisis" => Analisis::all()]);
	}    

  public function delete($id){
    $analisis = Analisis::find($id);
    $analisis->delete();
    return redirect()->action('Archivos\AnalisisController@index', ["deleted" => true, "analisis" => Analisis::all()]);
  }

  public function createView() {

    $laboratorios = laboratorios::all();

    return view('archivos.analisis.create', compact('laboratorios'));
  }

   public function edit($id) {

   	 $analisis = Analisis::findOrFail($id);

     return view('archivos.analisis.edit', compact('analisis'));
    
  }

}
