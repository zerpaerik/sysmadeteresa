<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pacientes\Paciente;
use App\Models\Personal;
use App\Models\Profesionales\Profesional;
use App\Models\Events\{Event, RangoConsulta};
use App\Models\Creditos;
use App\Models\Events;
use App\Models\Ciex;
use App\Models\Historiales;
use Calendar;
use Carbon\Carbon;
use DB;
use App\Models\Existencias\{Producto, Existencia, Transferencia};
use App\Historial;
use App\Consulta;

class EventController extends Controller
{

  public function index(Request $request)
  {
	 $personal = DB::table('personals as e')
    ->select('e.id','e.name','e.lastname','e.dni')
    ->join('events as p','p.profesional','=','e.id')
    ->get();
	

	
    if($request->isMethod('get')){
      $calendar = false;
      return view('events.index', ["calendar" => $calendar, "especialistas" => $personal]);
    }else{
      $calendar = Calendar::addEvents($this->getEvents($request->especialista))
      ->setOptions([
        'locale' => 'es',
      ]);
      return view('events.index',[ "calendar" => $calendar, "especialistas" => $personal]);
    }
  }

  public function show(Request $request,$id)
  {
    $event = DB::table('events as e')
    ->select('e.id','e.paciente','e.title','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','rg.start_time','rg.end_time','rg.id')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('rangoconsultas as rg','rg.id','=','e.time')
    ->where('e.id','=',$id)
    ->first();

    $historial = Historial::where('paciente_id','=',$event->pacienteId)->first();
    $consultas = Consulta::where('paciente_id','=',$event->pacienteId)->get();
    $personal = Personal::where('estatus','=',1)->get();
	$productos = Producto::where('almacen','=',2)->where("sede_id", "=", $request->session()->get('sede'))->get();
    $ciex = Ciex::all();
    return view('events.show',[
      'data' => $event,
      'historial' => $historial,
      'consultas' => $consultas,
      'personal' => $personal,
	  'productos' => $productos,
      'ciex' => $ciex
    ]);
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
    $data = ($args) ? Event::where('profesional', '=', $args)->get() : Event::all();
    if($data->count()) {
      foreach ($data as $key => $value) {
        $datetime = RangoConsulta::find($value->time);
        $events[] = Calendar::event(
          $value->title,
          false,
          new \DateTime($value->date." ".$datetime->start_time),
          new \DateTime($value->date." ".$datetime->end_time),
          null,
          [
            'color' => self::toggleType($value->entrada),
            'url' => 'event-'.$value->id
          ]
        );
      }
    }
    return $events;    
  }

  public function create(Request $request){
    $validator = \Validator::make($request->all(), [
      "paciente" => "required", 
      "especialista" => "required", 
      "date" => "required", 
      "time" => "required",
      "title" => "required"
    ]);

    if($validator->fails()){
      $this->createView([
        "fail" => true,
        "errors" => $validator->errors()
      ]);
    }

    $paciente = Paciente::find($request->paciente);

    $exists = Event::where("date", "=", Carbon::createFromFormat('d/m/Y', $request->date))
      ->where("time", "=", $request->time)
      ->get()->first();
    if(!$exists){
      $evt = Event::create([
        "paciente" => $request->paciente,
        "profesional" => $request->especialista,
        "date" => Carbon::createFromFormat('d/m/Y', $request->date),
        "time" => $request->time,
        "title" => $paciente->nombres . " " . $paciente->apellidos . " Paciente.",
        "monto" => $request->monto,
        "sede" => $request->session()->get('sede')
      ]);

      $credito = Creditos::create([
        "origen" => 'CONSULTAS',
        "descripcion" => 'CONSULTAS',
        "monto" => $request->monto,
        "tipo_ingreso" => 'EF',
        "id_sede" => $request->session()->get('sede'),
      ]);
	  
	  $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Consultas';
		  $historial->detalle = $paciente->nombres . " " . $paciente->apellidos . " Paciente.";
          $historial->id_usuario = \Auth::user()->id;
		  $historial->sede = $request->session()->get('sede');
          $historial->save();
    }

    $calendar = Calendar::addEvents($this->getEvents())
    ->setOptions([
      'locale' => 'es',
    ]);
    return redirect()->action('Events\EventController@index');

  }

  public function availableTime($e, $d, $m, $y){
    $times = Event::where('date', '=', $y."/".$m."/".$d)
    ->where('profesional', '=', $e)->get(['time']);
    $arrTimes = [];
    if($times){
      foreach ($times as $time) {
        array_push($arrTimes, $time->time);
      }
      return response()->json(RangoConsulta::whereNotIn("id", $arrTimes)->get(["start_time", "end_time", "id"]));
    }
    return response()->json(RangoConsulta::all()); 
  }

  public function createView($extra = []){
    $data = [
	  "especialistas" => Personal::where('tipo','=','Especialista')->orwhere('tipo','=','Tecnòlogo')->orwhere('tipo','=','ProfSalud')->where('estatus','=','1')->get(),
      "pacientes" => Paciente::where('estatus','=',1)->get(),
      "tiempos" => RangoConsulta::all(),
	  "ciex" => Ciex::all(),
    ];
    return view('consultas.create', $data + $extra);
  }
}