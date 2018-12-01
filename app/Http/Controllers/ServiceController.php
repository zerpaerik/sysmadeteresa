<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profesionales\Especialidad;
use App\Models\Profesionales\Profesional;
use App\Models\Events\{Event, RangoConsulta};
use App\Models\Creditos;
use App\Models\Servicios;
use App\Models\Events;
use App\Models\Pacientes;
use Calendar;
use Carbon\Carbon;
use DB;
use App\Historial;
use App\Consulta;
use App\Service;

class ServiceController extends Controller
{
	public function index(Request $request)
  	{
    if($request->isMethod('get')){
      $calendar = false;
      return view('service.index', ["calendar" => $calendar, "especialistas" => Profesional::all()]);
    }else{
      $calendar = Calendar::addEvents($this->getEvents($request->especialista))
      ->setOptions([
        'locale' => 'es',
      ]);
      return view('service.index',[ "calendar" => $calendar, "especialistas" => Profesional::all()]);
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
    $data = ($args) ? Service::where('especialista_id', '=', $args)->get() : Service::all();
    if($data->count()) {
      foreach ($data as $d) {
        $datetime = RangoConsulta::find($d->hora_id);
        $events[] = Calendar::event(
          $d->title,
          false,
          new \DateTime($d->date." ".$datetime->start_time),
          new \DateTime($d->date." ".$datetime->end_time),
          null,
          [
            'color' => self::toggleType($d->entrada),
            'url' => 'service-'.$d->id
          ]
        );
      }
    }
    return $events;    
  }

  public function show($id)
  {
    $services = DB::table('services as s')
    ->select('s.id','s.especialista_id','s.title','s.especialidad_id','s.paciente_id','s.servicio_id','s.date','s.hora_id','e.nombre as nomEspecialidad','e.id','pro.name as nombrePro','pro.apellidos as apellidoPro','pro.id as profesionalId','rg.start_time','rg.end_time','rg.id','sr.detalle as srDetalle','sr.id as srId','pc.nombres as nompac','pc.apellidos as apepac')
    ->join('especialidades as e','e.id','=','s.especialidad_id')
    ->join('profesionales as pro','pro.id','=','s.especialista_id')
    ->join('rangoconsultas as rg','rg.id','=','s.hora_id')
    ->join('servicios as sr','sr.id','=','s.servicio_id')
    ->join('pacientes as pc','pc.id','=','s.paciente_id')
    ->where('s.id','=',$id)
    ->first();
    return view('service.show',[
      'data' => $services,
    ]);
  }  
  public function createView($extra = []){
    $data = [
      "especialistas" => Profesional::all(),
      "especialidades" => Especialidad::all(),
      "servicios" => Servicios::all(),
      "tiempos" => RangoConsulta::all(),
      "pacientes" => Pacientes::where("estatus", '=', 1)->get()
    ];

    //dd($data);
    return view('service.create', $data + $extra);
  }

   public function create(Request $request){
    $validator = \Validator::make($request->all(), [
      "espcialidad" => "required", 
      "especialista" => "required", 
      "servicios" => "required", 
      "date" => "required", 
      "time" => "required",
    ]);

    if($validator->fails()){
      $this->createView([
        "fail" => true,
        "errors" => $validator->errors()
      ]);
    }
   $exists = Service::where('date',  Carbon::createFromFormat('d/m/Y', $request->date))
    ->where("hora_id", "=", $request->time)
    ->first();

    $especialista = Profesional::find($request->especialista);
    $servicio = Servicios::find($request->servicio);

    if(!$exists){
      $evt = Service::create([
        "especialista_id" => $request->especialista,
        "especialidad_id" => $request->especialidad,
        "paciente_id" => $request->paciente,
        "date" => Carbon::createFromFormat('d/m/Y', $request->date),
        "hora_id" => $request->time,
        "servicio_id" => $request->servicios,
        "title" => $especialista->name." ".$especialista->apellidos." "."Servicio"
      ]);

    $calendar = Calendar::addEvents($this->getEvents())
    ->setOptions([
      'locale' => 'es',
    ]);
    return redirect()->action('ServiceController@index');

  }

}
 /* public function availableTime($e, $d, $m, $y){
    $times = Service::where('date', '=', $y."/".$m."/".$d)
    ->where('especialista_id', '=', $e)->get(['hora_id']);
    $arrTimes = [];
    if($times){
      foreach ($times as $time) {
        array_push($arrTimes, $time->time);
      }
      return response()->json(RangoConsulta::whereNotIn("id", $arrTimes)->get(["start_time", "end_time", "id"]));
    }
    return response()->json(RangoConsulta::all()); 
  }*/

}