<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Debitos;
use App\Models\Historiales;
use App\Models\Comunica;
use DB;
use Carbon\Carbon;
use Auth;


class ComunicaController extends Controller
{

	public function index(Request $request){

  if(! is_null($request->fecha)) {

      $comunica = DB::table('comunicas as a')
      ->select('a.id','a.descripcion','a.asunto','a.created_at','a.respuesta','a.estatus','a.profesional','u.name','u.lastname')
      ->join('users as u','u.id','a.profesional')
      ->whereDate('a.created_at','=' ,$request->fecha)
      ->orderby('a.id','desc')
      ->paginate(200000);  

    } else {

        $comunica = DB::table('comunicas as a')
      ->select('a.id','a.descripcion','a.asunto','a.created_at','a.respuesta','a.estatus','a.profesional','u.name','u.lastname')
      ->join('users as u','u.id','a.profesional')
      ->whereDate('a.created_at','=' ,Carbon::today()->toDateString())
      ->orderby('a.id','desc')
      ->paginate(200000);  


    }  


        return view('comunicaciones.index', compact('comunica'));  
	}




	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'descripcion' => 'required|string|max:255'
      
        ]);
        if($validator->fails()) 
          return redirect()->action('GastosController@createView', ['errors' => $validator->errors()]);
		$gastos = Debitos::create([
	      'descripcion' => $request->descripcion,
	      'monto' => $request->monto,
        'nombre' => $request->nombre,
	      'origen' => 'RELACION DE GASTOS',
	      'id_sede' => $request->session()->get('sede'),
        'usuario' => Auth::user()->id,
        'date' => date('Y-m-d')
   		]);
		
		  
		  
		return redirect()->action('GastosController@index', ["created" => true, "gastos" => Debitos::all()]);
	}    

  public function delete($id){
    $gastos = Debitos::find($id);
    $gastos->delete();
    return redirect()->action('GastosController@index', ["deleted" => true, "analisis" => Debitos::all()]);
  }

  public function responde($id) {

    $comunica = Comunica::where('id','=',$id)->first();

    return view('comunicaciones.responder', compact('comunica'));
  }

   

      public function edit(Request $request){
      $p = Comunica::find($request->id);
      $p->respuesta = $request->respuesta;
      $p->estatus = 2;
      $p->usuario_r = Auth::user()->id;
      $res = $p->save();
      return redirect()->action('ComunicaController@index', ["edited" => $res]);
    }

  

}
