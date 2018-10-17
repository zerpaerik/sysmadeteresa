<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pacientes\Paciente;
use App\Models\Profesionales\Profesional;
use App\Models\Events\{Event, RangoConsulta};
use App\Models\Creditos;
use Calendar;
use Carbon\Carbon;

class EventController extends Controller
{

  public function index(Request $request)
  {
    if($request->isMethod('get')){
      $calendar = false;
      return view('events.index', ["calendar" => $calendar, "especialistas" => Profesional::all()]);
    }else{
      $calendar = Calendar::addEvents($this->getEvents($request->especialista))
      ->setOptions([
        'locale' => 'es',
      ]);
      return view('events.index',[ "calendar" => $calendar, "especialistas" => Profesional::all()]);
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
            'url' => 'event/'.$value->id
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

    $evt = Event::create([
      "paciente" => $request->paciente,
      "profesional" => $request->especialista,
      "date" => Carbon::createFromFormat('d/m/Y', $request->date),
      "time" => $request->time,
      "title" => $paciente->nombres . " " . $paciente->apellidos . " Paciente.",
    ]);

    if ($evt) {
      $cred = Creditos::create([
        "origen" => 'CONSULTAS',
        "monto" => $request->monto,
        "tipo_ingreso" => 'EF',
        "id_sede" => $request->session()->get('sede')

      ]);
    }else{
      //
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
      "especialistas" => Profesional::all(),
      "pacientes" => Paciente::all(),
      "tiempos" => RangoConsulta::all()
    ];
    return view('consultas.create', $data + $extra);
  }
}