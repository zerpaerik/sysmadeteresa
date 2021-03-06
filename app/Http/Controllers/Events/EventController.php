<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pacientes\Paciente;
use App\Models\Pacientes;
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
use PDF;
use App\Models\Existencias\{Producto, Existencia, Transferencia};
use App\Historial;
use App\User;
use App\Consulta;
use Toastr;
use Auth;

class EventController extends Controller
{

  public function index(Request $request)
  {
	 $personal = DB::table('personals as e')
    ->select('e.id','e.name','e.lastname','e.dni')
    ->join('events as p','p.profesional','=','e.id')
	->groupBy('p.profesional')
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

  public function all(Request $request)
  {

    if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    

    $eventos = DB::table('events as e')
    ->select('e.id as EventId','e.eliminado_por','e.paciente','e.tipopago','e.es_delete','e.tipo','e.created_at','e.tipo','e.atendido','e.title','e.sede','e.monto','e.profesional','e.usuario','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','us.name as nombrePro','us.lastname as apellidoPro','us.id as profesionalId','u.name','u.lastname')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('users as us','us.id','=','e.profesional')
    ->join('users as u','u.id','e.usuario')
    ->whereBetween('e.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
    ->where('e.sede','=',$request->session()->get('sede'))
    ->get();

     $consultas = Event::where('tipo', 'CONSULTAS')
                                ->where('sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

     $controles = Event::where('tipo', 'CONTROLES')
                                ->where('sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

    $atconsultas = Event::where('tipo', 'CONSULTAS')
                                ->where('sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->where('atendido','=',1)
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

     $atcontroles = Event::where('tipo', 'CONTROLES')
                                ->where('sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->where('atendido','=',1)
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

  } else {

      $eventos = DB::table('events as e')
    ->select('e.id as EventId','e.eliminado_por','e.paciente','e.tipopago','e.es_delete','e.tipo','e.created_at','e.tipo','e.atendido','e.title','e.sede','e.monto','e.profesional','e.usuario','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','us.name as nombrePro','us.lastname as apellidoPro','us.id as profesionalId','u.name','u.lastname')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('users as us','us.id','=','e.profesional')
    ->join('users as u','u.id','e.usuario')
    ->whereDate('e.created_at', '=',Carbon::today()->toDateString())
    ->where('e.sede','=',$request->session()->get('sede'))
    ->get();

     $consultas = Event::where('tipo', 'CONSULTAS')
                                ->where('sede','=', $request->session()->get('sede'))
                                    ->whereDate('created_at', '=',Carbon::today()->toDateString())
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

     $controles = Event::where('tipo', 'CONTROLES')
                                ->where('sede','=', $request->session()->get('sede'))
                                  ->whereDate('created_at', '=',Carbon::today()->toDateString())
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

    $atconsultas = Event::where('tipo', 'CONSULTAS')
                                ->where('sede','=', $request->session()->get('sede'))
                                  ->whereDate('created_at', '=',Carbon::today()->toDateString())
                                    ->where('atendido','=',1)
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();

     $atcontroles = Event::where('tipo', 'CONTROLES')
                                ->where('sede','=', $request->session()->get('sede'))
                                  ->whereDate('created_at', '=',Carbon::today()->toDateString())
                                    ->where('atendido','=',1)
                                    ->select(DB::raw('COUNT(*) as cantidad'))
                                    ->first();


  }




    return view('consultas.index',compact('eventos','consultas','controles','atconsultas','atcontroles'));
  }

  public function delete_consulta($id)
  {


       $user= User::where('id','=',Auth::user()->id)->first();


    $consulta = Event::where('id','=',$id)->first();
    $consulta->es_delete= 1;
    $consulta->eliminado_por= $user->name.' '.$user->lastname;
    $consulta->save();


    $creditos = Creditos::where('id_event','=',$id);
    $creditos->delete();


    return back();
  } 

    public function atendido($id)
  {
    $consulta = Event::find($id);
    $consulta->atendido=1;
    $consulta->update();

    Toastr::success('Atendido Exitosamente.', 'Consulta!', ['progressBar' => true]);
    return back();
  } 

  public function editView_consulta($id)
  {
  
    $paciente = DB::table('events as e')
    ->select('e.id','e.paciente','e.tipopago','e.title','e.profesional','e.tipo','e.date','e.monto','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->where('e.id','=',$id)
    ->first();


    $especialistas =  Personal::where('tipo','=','Especialista')->orwhere('tipo','=','Tecnòlogo')->orwhere('tipo','=','ProfSalud')->where('estatus','=','1')->get();

    $tiempos = RangoConsulta::all();
    
    $ciex = Ciex::all();

    return view('consultas.edit',[
      'paciente' => $paciente,
      'especialistas' => $especialistas,
      'tiempos' => $tiempos,
      'ciex' => $ciex
    ]);   
  
  }

  public function edit_consulta(Request $request)
  {
    DB::table('events')
            ->where('id', $request->event)
            ->update([
              'profesional' => $request->especialista,
              'paciente' => $request->paciente,
              'date' => Carbon::today()->toDateString(),
              'time' => $request->time,
              'monto' => $request->monto,
              'tipo' => $request->tipo,
              'tipopago' => $request->tipopago
            ]);

            if ($request->tipopago == 'EF'){
              $efectivo = $request->monto;
              $tarjeta = '0';
      
            } else {
              $efectivo ='0';
              $tarjeta = $request->monto;
            }  

    DB::table('creditos')
            ->where('id_event', $request->event)
            ->update([
              'monto' => $request->monto,
              'tipo_ingreso' => $request->tipopago,
              'efectivo' => $efectivo,
              'tarjeta'  => $tarjeta
            ]);        
     


  return redirect('consulta');            
  }

  public function show(Request $request,$id)
  {
    $event = DB::table('events as e')
    ->select('e.id as evento','e.paciente','e.title','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->where('e.id','=',$id)
    ->first();

    $evento= DB::table('events')
    ->select('*')
    ->where('id','=',$id)
    ->first();


  //  $edad = Carbon::parse($event->fechanac)->age;
    $historial = Historial::where('paciente_id','=',$evento->paciente)->first();
    $consultas = Consulta::where('paciente_id','=',$evento->paciente)->get();
    $personal = Personal::where('estatus','=',1)->get();
	$productos = Producto::where('almacen','=',2)->where("sede_id", "=", $request->session()->get('sede'))->get();
    $ciex = Ciex::all();
    return view('events.show',[
      'data' => $event,
      'historial' => $historial,
      'consultas' => $consultas,
      'personal' => $personal,
	  'productos' => $productos,
      'ciex' => $ciex,
    //'edad' => $edad,
      'evento' => $evento
    ]);
  }


  public function ticket_ver($id) 
  {
    $paciente = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.created_at','e.tipo','e.title','e.profesional','e.date','e.monto','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->where('e.id','=',$id)
    ->first();


    $view = \View::make('consultas.ticket_consulta')->with('paciente', $paciente);
    $pdf = \App::make('dompdf.wrapper');
                //$pdf->setPaper('A5', 'landscape');
                //$pdf->setPaper(array(0,0,600.00,360.00));
                $pdf->setPaper(array(0,0,800.00,3000.00));
                $pdf->loadHTML($view);
    
    return $pdf->stream('ticket_ver');
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

  
    
        $evt = new Event;
        $evt->paciente=$request->paciente;
        $evt->profesional=$request->especialista;
        $evt->date=Carbon::today()->toDateString();
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=$request->monto;
        $evt->sede=$request->session()->get('sede');
        $evt->tipo=$request->tipo;
        $evt->tipopago=$request->tipopago;
        $evt->usuario=\Auth::user()->id;
        $evt->save();
/*
      $credito = Creditos::create([
        "origen" => 'CONSULTAS',
        "descripcion" => 'CONSULTAS',
        "monto" => $request->monto,
        "tipo_ingreso" => $request->tipopago,
        "id_sede" => $request->session()->get('sede'),
        "id_event" => $evt->id,
        "date" => date('Y-m-d')
      ]);*/
      
      $creditos = new Creditos();
                    $creditos->origen = 'CONSULTAS';
                    $creditos->descripcion = 'CONSULTAS';
                    $creditos->monto= $request->monto;
                    $creditos->id_sede = $request->session()->get('sede');
                    $creditos->tipo_ingreso = $request->tipopago;
                    if($request->tipopago=='EF'){
                      $creditos->efectivo = $request->monto;
                      }else{
                      $creditos->tarjeta = $request->monto;
                      }
                    $creditos->id_event = $evt->id;
                    $creditos->date = date('Y-m-d');
                    $creditos->save();
	  
	
  
    return redirect()->action('Events\EventController@all');

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

  public function createView (){ 

    //dd($request->filtro);


    $especialistas = User::where('tipo','=','1')->get();
    $tiempos = RangoConsulta::all();
    $ciex = Ciex::all();

    
    return view('consultas.create', compact('especialistas','tiempos','ciex'));
  }

   public function llama($id){
    $event = Event::find($id);
    $event->llamado= 1;
    $event->save();
    
   return back();

  }


}
