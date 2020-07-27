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
