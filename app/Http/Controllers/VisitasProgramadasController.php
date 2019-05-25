<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Events\{Event, RangoConsulta};
use App\Models\Centros;
use Calendar;
use Carbon\Carbon;
use DB;
use App\VisitasProgramadas;
use App\User;
use Auth;

class VisitasProgramadasController extends Controller
{

	public function index(Request $request)
 
    {

    $visitadores = DB::table('users as a')
   ->select('a.id','a.name','a.lastname')
   ->join('visitas_programadas as vp','vp.visitador','=','a.id')
   ->groupBy('a.id')
   ->get(); 

    if($request->isMethod('get')){
      $calendar = false;
      return view('visitasp.index', ["calendar" => $calendar, "visitadores" => $visitadores]);
    }else{
      $calendar = Calendar::addEvents($this->getEvents($request->visitador))
      ->setOptions([
        'locale' => 'es',
      ]);

      return view('visitasp.index',[ "calendar" => $calendar, "visitadores" =>$visitadores]);
    }
  }
  private static function toggleType($type){
    switch ($type) {
      case "0":
        return "#43D12C";
        break;
      
      default:
        return '#f05050';
        break;
    }
  }

    private function getEvents($args = null){
    $events = [];

    $data = ($args) ? VisitasProgramadas::where('visitador', '=', $args)->get() : VisitasProgramadas::all();

    if($data) {
      foreach ($data as $d) {
        $datetime = RangoConsulta::where('id','=',$d->hora_id)->get(['start_time','end_time'])->first();
        $ini=$datetime->start_time;
        $fin=$datetime->end_time; 
        $events[] = Calendar::event(
          $d->title,
          false,
          new \DateTime($d->date." ".$ini),
          new \DateTime($d->date." ".$fin),
          null,
          [
            'color' => self::toggleType($d->entrada),
            'url' => 'visitasp-'.$d->id
          ]
        );
      }
    }
    return $events;    
  }
  public function inicio(Request $request)
  {

    if(!is_null($request->fecha)){
      $f1=$request->fecha;
      $f2=$request->fecha2;
    $visitap = DB::table('visitas_programadas as a')
   ->select('a.id','a.date','a.hora_id','a.usuario','a.created_at','a.centro','cn.name as centro','a.title','a.visitador','u.name','u.lastname','rg.start_time','rg.end_time')
    ->join('rangoconsultas as rg','rg.id','=','a.hora_id')
    ->join('centros as cn','cn.id','=','a.centro')
    ->join('users as u','u.id','a.usuario')
    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
    ->get(); 

  } else {

       $visitap = DB::table('visitas_programadas as a')
     ->select('a.id','a.date','a.hora_id','a.usuario','a.created_at','a.centro','cn.name as centro','a.title','a.visitador','u.name','u.lastname','rg.start_time','rg.end_time')
    ->join('rangoconsultas as rg','rg.id','=','a.hora_id')
    ->join('centros as cn','cn.id','=','a.centro')
    ->join('users as u','u.id','a.usuario')
    ->whereDate('a.created_at','=',Carbon::now()->toDateString())
    ->get(); 

  

    $f1=Carbon::now()->toDateString();
    $f2=Carbon::now()->toDateString();


  }
    

    return view('visitasp.inicio',[
      'data' => $visitap,
      'f1' => $f1,
      'f2' => $f2
    ]);
  }

  public function delete($id)
  {
    $visitasp = VisitasProgramadas::find($id);  
    $visitasp->delete();
    return back();
  }

  public function editView($id)
  {
    $visitador = User::where('role_id','=',8)->get();
    $centros = Centros::where('estatus','=',1)->get();
    $tiempos = RangoConsulta::all();

    $visitasp = VisitasProgramadas::find($id);

     


    return view('visitasp.edit', 
      [
      'visitador' => $visitador,
      'tiempos' =>  $tiempos, 
      'centros' => $centros,
      'visitasp' => $visitasp
    ]);
  }

  public function edit(Request $request)
  {
    DB::table('visitas_programadas')
    ->where('id',$request->id_visita)
    ->update([    
        "centro" => $request->centro,
        "date" => $request->date,
        "hora_id" => $request->time
      ]);

    return redirect()->action('VisitasProgramadasController@inicio');
  }

   public function edit2(Request $request)
  {
    DB::table('visitas_programadas')
    ->where('id',$request->id_visita)
    ->update([    
        "observacion" => $request->observacion,
        "fecha_obs" => Carbon::now()
      ]);

    return redirect()->action('VisitasProgramadasController@inicio');
  }


 

  public function show($id)
  {
     $visitap = DB::table('visitas_programadas as a')
    ->select('a.id','a.date','a.hora_id','a.observacion','a.fecha_obs','a.usuario','a.centro','a.title','a.visitador','cn.name as centro','rg.start_time','rg.end_time','u.name','u.lastname')
    ->join('rangoconsultas as rg','rg.id','=','a.hora_id')
    ->join('centros as cn','cn.id','=','a.centro')
    ->join('users as u','u.id','a.usuario')
    ->where('a.id','=',$id)
    ->first();
    return view('visitasp.show',[
      'data' => $visitap
    ]);
  }  
  public function createView($extra = []){
  
    $visitador = User::where('role_id','=',8)->get();
    $centros = Centros::where('estatus','=',1)->get();
    $tiempos = RangoConsulta::all();
	
	
	
    //dd($data);
    return view('visitasp.create', compact('visitador', 'centros','tiempos'));
	
  }

    

   public function create(Request $request){

   	$centro=Centros::where('id','=',$request->centro)->first();
   	$visitador= User::where('id','=',\Auth::user()->id)->first();

        $evt = VisitasProgramadas::create([
        "centro" => $request->centro,
        "date" => Carbon::createFromFormat('d/m/Y', $request->date),
        "hora_id" => $request->time,
        "visitador" => \Auth::user()->id,
        "usuario" =>\Auth::user()->id,
        "title" => $centro->name." "."Centro Mèdico"."Visitador ".$visitador->name." ".$visitador->lastname
      ]);

    return redirect()->action('VisitasProgramadasController@inicio');
  

}
 

}