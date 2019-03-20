<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Consulta;
use App\Http\Requests\CreateConsultaRequest;
use Carbon\Carbon;
use App\Historial;
use DB;
use App\Models\ConsultaMateriales;
use App\Models\Existencias\{Producto, Existencia, Transferencia,Historiales};
use App\Models\Pacientes\Paciente;
use App\Models\Personal;
use App\Models\Profesionales\Profesional;
use App\Models\Events\{Event, RangoConsulta};
use App\Models\Creditos;
use App\Models\Ciex;
use Toastr;
use Auth;

class ConsultaController extends Controller
{
   public function index(Request $request){



             if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;  


          $atenciones = DB::table('consultas as a')
        ->select('a.id','a.paciente_id','a.created_at','a.profesional_id','a.prox','b.nombres','b.apellidos','c.name as nompro','c.apellidos as apepro')
        ->join('pacientes as b','b.id','a.paciente_id')
        ->join('profesionales as c','c.id','a.profesional_id')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','desc')
        ->get();

      } else {


          $atenciones = DB::table('consultas as a')
        ->select('a.id','a.paciente_id','a.created_at','a.profesional_id','a.prox','b.nombres','b.apellidos','c.name as nompro','c.apellidos as apepro')
        ->join('pacientes as b','b.id','a.paciente_id')
        ->join('profesionales as c','c.id','a.profesional_id')
    
        ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
        ->orderby('a.id','desc')
        ->get();




      }
      
       
        return view('consultas.proxima.index', ["atenciones" => $atenciones]);
    }


  
     public function indexh(){


      $historias = DB::table('events as e')
        ->select('e.id','e.paciente','e.title','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.dni','p.apellidos','p.id as pacienteId',
    'per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','rg.start_time','rg.end_time','rg.id',
    'a.pa','a.pulso','a.temperatura','a.peso','a.fur','a.MAC','a.motivo_consulta','a.evolucion_enfermedad','a.examen_fisico_regional','a.presuncion_diagnostica','a.diagnostico_final','a.CIEX','a.CIEX2','a.examen_auxiliar','a.plan_tratamiento','a.observaciones','a.paciente_id','a.profesional_id','a.created_at','a.prox','a.personal','a.apetito','a.sed','a.orina','a.card','a.animo','a.deposiciones','a.g','a.p','a.pap',
    'b.antecedentes_familiar','b.antecedentes_personales','b.antecedentes_patologicos','b.alergias','b.menarquia','b.prs','b.paciente_id')
    ->join('consultas as a','a.paciente_id','e.paciente')
    ->join('historials as b','e.paciente','b.paciente_id')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('rangoconsultas as rg','rg.id','=','e.time')
    ->groupBy('e.paciente')
    ->get();
    
   
        return view('consultas.historias.index', ["historias" => $historias]);
	}


     public function indexp(){


      $historias = DB::table('events as e')
        ->select('e.id','e.paciente','e.title','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.dni','p.apellidos','p.id as pacienteId',
    'per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','rg.start_time','rg.end_time','rg.id',
    'a.pa','a.id as consulta','a.pulso','a.temperatura','a.peso','a.fur','a.MAC','a.motivo_consulta','a.evolucion_enfermedad','a.examen_fisico_regional','a.presuncion_diagnostica','a.diagnostico_final','a.CIEX','a.CIEX2','a.examen_auxiliar','a.plan_tratamiento','a.observaciones','a.paciente_id','a.profesional_id','a.created_at','a.prox','a.personal','a.apetito','a.sed','a.orina','a.card','a.animo','a.deposiciones','a.g','a.p','a.pap','a.pendiente',
    'b.antecedentes_familiar','b.antecedentes_personales','b.antecedentes_patologicos','b.alergias','b.menarquia','b.prs','b.paciente_id')
    ->where('a.pendiente','=',1)
    ->join('consultas as a','a.paciente_id','e.paciente')
    ->join('historials as b','e.paciente','b.paciente_id')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('rangoconsultas as rg','rg.id','=','e.time')
    ->groupBy('e.paciente')
    ->get();


    
   
        return view('consultas.historiasp.index', ["historias" => $historias]);
  }

   public function af(){
     
      
    return view('consultas.afotros');
  }

  public function ningunof(){
      
    return view('consultas.ningunof');
  }

   public function ap(){
     
      
    return view('consultas.apotros');
  }

    public function ningunop(){
      
    return view('consultas.ningunop');
  }

   public function apa(){
     
      
    return view('consultas.apaotros');
  }

    public function ningunopa(){
      
    return view('consultas.ningunopa');
  }

    public function alsi(){
      
    return view('consultas.alsi');
  }

     public function alno(){
      
    return view('consultas.alno');
  }
	
	public function searchh(Request $request)
    {
      $search = $request->dni;
      $split = explode(" ",$search);
    
      if (!isset($split[1])) {
       
        $split[1] = '';
        $historias = $this->elasticSearch1($split[0],$split[1]);
      
        return view('consultas.historias.search', ["historias" => $historias]); 
      }else{
        $historias = $this->elasticSearch1($split[0],$split[1]); 
      
        return view('consultas.historias.search', ["historias" => $historias]);   
      }    
    }
	
  
  
      private function elasticSearch1($dni)
  { 
        $historias = DB::table('events as e')
        ->select('e.id','e.paciente','e.title','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.dni','p.apellidos','p.id as pacienteId',
		'per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','rg.start_time','rg.end_time','rg.id',
		'a.pa','a.pulso','a.temperatura','a.peso','a.fur','a.MAC','a.motivo_consulta','a.evolucion_enfermedad','a.examen_fisico_regional','a.presuncion_diagnostica','a.diagnostico_final','a.CIEX','a.CIEX2','a.examen_auxiliar','a.plan_tratamiento','a.observaciones','a.paciente_id','a.profesional_id','a.created_at','a.prox','a.personal','a.apetito','a.sed','a.orina','a.card','a.animo','a.deposiciones','a.g','a.p','a.pap',
		'b.antecedentes_familiar','b.antecedentes_personales','b.antecedentes_patologicos','b.alergias','b.menarquia','b.prs','b.paciente_id')
		->join('consultas as a','a.paciente_id','e.paciente')
		->join('historials as b','e.paciente','b.paciente_id')
		->join('pacientes as p','p.id','=','e.paciente')
		->join('personals as per','per.id','=','e.profesional')
		->join('rangoconsultas as rg','rg.id','=','e.time')
		->where('p.dni','like','%'.$dni.'%')
		->groupBy('e.paciente')
        ->get();
        return $historias;
  }
  
  public function show(Request $request,$id)
  {

    
    $event = DB::table('events as e')
    ->select('e.id','e.paciente','e.title','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','rg.start_time','rg.end_time','rg.id')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('rangoconsultas as rg','rg.id','=','e.time')
    ->where('e.paciente','=',$id)
    ->first();
    $historial = Historial::where('paciente_id','=',$event->pacienteId)->first();
    $consultas = Consulta::where('paciente_id','=',$event->pacienteId)->get();
    $personal = Personal::where('estatus','=',1)->get();
    return view('consultas.historias.show',[
      'data' => $event,
      'historial' => $historial,
      'consultas' => $consultas,
      'personal' => $personal,
    ]);
  }


   public function editview(Request $request,$id)
  {
  
    $historias = DB::table('events as e')
        ->select('e.id','e.paciente','e.title','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.dni','p.apellidos','p.id as pacienteId',
    'per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','rg.start_time','rg.end_time','rg.id',
    'a.pa','a.id as consulta','a.pulso','a.temperatura','a.peso','a.fur','a.MAC','a.motivo_consulta','a.evolucion_enfermedad','a.examen_fisico_regional','a.pendiente','a.presuncion_diagnostica','a.diagnostico_final','a.amenorrea','a.andria','a.CIEX','a.CIEX2','a.examen_auxiliar','a.plan_tratamiento','a.observaciones','a.paciente_id','a.mac','a.tipo_enfermedad','a.profesional_id','a.created_at','a.prox','a.personal','a.apetito','a.sed','a.orina','a.card','a.animo','a.deposiciones','a.g','a.p','a.pap',
    'b.antecedentes_familiar','b.antecedentes_personales','b.antecedentes_patologicos','b.alergias','b.menarquia','b.prs','b.paciente_id')
    ->join('consultas as a','a.paciente_id','e.paciente')
    ->join('historials as b','e.paciente','b.paciente_id')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('rangoconsultas as rg','rg.id','=','e.time')
    ->where('a.id','=',$id)
    ->first();

    $especialistas =  Personal::where('tipo','=','Especialista')->orwhere('tipo','=','Tecnòlogo')->orwhere('tipo','=','ProfSalud')->where('estatus','=','1')->get();

    $tiempos = RangoConsulta::all();

    $productos = Producto::where('almacen','=',2)->where("sede_id", "=", $request->session()->get('sede'))->get();
    
    $ciex = Ciex::all();

        $personal = Personal::where('estatus','=',1)->get();


    return view('consultas.historiasp.edit',[
      'historias' => $historias,
      'especialistas' => $especialistas,
      'tiempos' => $tiempos,
      'ciex' => $ciex,
      'personal' => $personal,
      'productos' => $productos
    ]);   
  
  }




    public function create(Request $request)
    {

  
      $users = DB::table('users')
            ->select('*')
            ->where('id','=',\Auth::user()->id)
            ->first();
    	
		$consulta = new Consulta;
		$consulta->pa =$request->pa;
		$consulta->pulso =$request->pulso;
		$consulta->temperatura =$request->temperatura;
		$consulta->peso =$request->peso;
		$consulta->fur =$request->fur;
		$consulta->mac =$request->mac;
		$consulta->motivo_consulta =$request->motivo_consulta;
		$consulta->tipo_enfermedad =$request->tipo_enfermedad;
		$consulta->evolucion_enfermedad =$request->evolucion_enfermedad;
		//$consulta->examen_fisico_regional =$request->examen_fisico_regional;

    $consulta->piel =$request->piel;
    $consulta->mamas =$request->mamas;
    $consulta->abdomen =$request->abdomen;
    $consulta->genext =$request->genext;
    $consulta->genint =$request->genint;
    $consulta->miembros =$request->miembros;

		$consulta->presuncion_diagnostica =$request->presuncion_diagnostica;
		$consulta->diagnostico_final =$request->diagnostico_final;
		$consulta->ciex =json_encode($request->ciex);
		$consulta->ciex2=json_encode($request->ciex2);
		$consulta->examen_auxiliar=$request->examen_auxiliar;
		$consulta->plan_tratamiento =$request->plan_tratamiento;
		$consulta->observaciones =$request->observaciones;
		$consulta->paciente_id =$request->paciente_id;
		$consulta->profesional_id =$request->profesional_id;
		$consulta->prox =$request->prox;
		$consulta->personal =$users->name . " " .$users->lastname;
		$consulta->apetito =$request->apetito;
		$consulta->sed =$request->sed;
		$consulta->orina =$request->orina;
		$consulta->animo =$request->animo;
    $consulta->amenorrea =$request->amenorrea;
    $consulta->andria =$request->andria;
		$consulta->g =$request->g;
		$consulta->p =$request->p;
		$consulta->pap =$request->pap;
		$consulta->deposiciones =$request->deposiciones;
		$consulta->card =$request->card;
    $consulta->pendiente =$request->pendiente;
		$consulta->save();

    $event = Event::find($request->evento);
    $event->atendido=1;
    $event->update();


		
		
	
	  Toastr::success('Registrado Exitosamente.', 'Consulta!', ['progressBar' => true]);
      return redirect()->action('Events\EventController@all', ["edited" => $consulta]);
		 
    }
      public function edit(Request $request)
    {
      
    $consulta = Consulta::find($request->id);
    $consulta->pa =$request->pa;
    $consulta->pulso =$request->pulso;
    $consulta->temperatura =$request->temperatura;
    $consulta->peso =$request->peso;
    $consulta->fur =$request->fur;
    $consulta->mac =$request->mac;
    $consulta->motivo_consulta =$request->motivo_consulta;
    $consulta->tipo_enfermedad =$request->tipo_enfermedad;
    $consulta->evolucion_enfermedad =$request->evolucion_enfermedad;
    $consulta->examen_fisico_regional =$request->examen_fisico_regional;
    $consulta->presuncion_diagnostica =$request->presuncion_diagnostica;
    $consulta->diagnostico_final =$request->diagnostico_final;
    $consulta->ciex =$request->ciex;
    $consulta->ciex2=$request->ciex2;
    $consulta->examen_auxiliar=$request->examen_auxiliar;
    $consulta->plan_tratamiento =$request->plan_tratamiento;
    $consulta->observaciones =$request->observaciones;
    $consulta->profesional_id =$request->profesional_id;
    $consulta->prox =$request->prox;
    $consulta->personal =$request->personal;
    $consulta->apetito =$request->apetito;
    $consulta->sed =$request->sed;
    $consulta->orina =$request->orina;
 $consulta->amenorrea =$request->amenorrea;
    $consulta->andria =$request->andria;

    $consulta->animo =$request->animo;
    $consulta->g =$request->g;
    $consulta->p =$request->p;
    $consulta->pap =$request->pap;
    $consulta->deposiciones =$request->deposiciones;
    $consulta->card =$request->card;
    $consulta->pendiente =$request->pendiente;
    $consulta->save();


    
  
    Toastr::success('Editado Exitosamente.', 'Historia!', ['progressBar' => true]);
      return redirect()->action('ConsultaController@indexp', ["edited" => $consulta]);
     
    }
}
 ?>