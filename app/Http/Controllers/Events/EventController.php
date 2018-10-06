<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pacientes\Paciente;
use App\Models\Profesionales\Profesional;
use App\Models\Events\Event;
use App\Models\Creditos\Credito;
use Calendar;
use Carbon\Carbon;

class EventController extends Controller
{

  public function index()
  {
    $calendar = Calendar::addEvents($this->getEvents())
    ->setOptions([
    	'locale' => 'es',
    ]);
    return view('events.index', compact('calendar'));
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

  private function getEvents(){
    $events = [];
    $data = Event::all();
    if($data->count()) {
      foreach ($data as $key => $value) {
        $events[] = Calendar::event(
          $value->title,
          false,
          new \DateTime($value->start_date),
          new \DateTime($value->end_date),
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
      "start_date" => "required", 
      "title" => "required"
    ]);

    if($validator->fails()){
      $this->createView([
        "fail" => true,
        "errors" => $validator->errors()
      ]);
    }

    $start = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_date ." ". $request->start_time . ":00");

    $end = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_date ." ". $request->end_time . ":00");

    $paciente = Paciente::find($request->paciente);

    $evt = Event::create([
      "paciente" => $request->paciente,
      "profesional" => $request->especialista,
      "start_date" => $start,
      "end_date" => $end,
      "title" => $paciente->nombres . " " . $paciente->apellidos . " Paciente.",
    ]);

    if ($evt) {
      $cred = Credito::create([
        "monto" => $request->monto,
        "event_id" => $evt->id
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

  public function createView($extra = []){
    $data = [
      "especialistas" => Profesional::all(),
      "pacientes" => Paciente::all()
    ];
    return view('consultas.create', $data + $extra);
  }
}