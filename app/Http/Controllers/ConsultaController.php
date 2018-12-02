<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consulta;
use App\Http\Requests\CreateConsultaRequest;
use Carbon\Carbon;
use DB;


class ConsultaController extends Controller
{


   public function index(){
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $atenciones = $this->elasticSearch($inicio,$final,'','');
       
        return view('consultas.proxima.index', ["atenciones" => $atenciones]);
    }

    public function search(Request $request)
    {
      $search = $request->nom;
      $split = explode(" ",$search);

      if (!isset($split[1])) {
       
        $split[1] = '';
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]);

   
       
        return view('consultas.proxima.search', ["atenciones" => $atenciones]); 

      }else{
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]); 

      
       
        return view('consultas.proxima.search', ["atenciones" => $atenciones]);   
      }    
    }

     private function elasticSearch($initial, $final,$nom,$ape)
  { 
        $atenciones = DB::table('consultas as a')
        ->select('a.id','a.paciente_id','a.created_at','a.profesional_id','a.prox','b.nombres','b.apellidos','c.name as nompro','c.apellidos as apepro')
        ->join('pacientes as b','b.id','a.paciente_id')
        ->join('profesionales as c','c.id','a.profesional_id')
        ->where('b.nombres','like','%'.$nom.'%')
        ->where('b.nombres','like','%'.$ape.'%')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($final)), date('Y-m-d 23:59:59', strtotime($final))])
        ->orderby('a.id','desc')
        ->paginate(20);
        return $atenciones;

  }



    public function create(Request $request)
    {
    	Consulta::create([
    		'pa' => $request->pa,
    		'pulso' => $request->pulso,
    		'temperatura' => $request->temperatura,
    		'peso' => $request->peso,
    		'fur' => $request->fur,
            'mac' => $request->mac,
            'g' => $request->g,
            'p' => $request->p,
            'pap' => $request->pap,
    		'motivo_consulta' => $request->motivo_consulta,
    		'tipo_enfermedad' => $request->tipo_enfermedad,
    		'evolucion_enfermedad' => $request->evolucion_enfermedad,
    		'examen_fisico_regional' => $request->examen_fisico,
    		'presuncion_diagnostica' => $request->presuncion_diagnostica,
    		'diagnostico_final' => $request->diagnostico_final,
    		'CIEX' => $request->ciex1,
    		'CIEX2' => $request->ciex2,
    		'examen_auxiliar' => $request->examen_auxiiar,
    		'plan_tratamiento' => $request->plan_tratamiento,
    		'obervaciones' => $request->observaciones,
    		'paciente_id' => $request->paciente_id,
    		'profesional_id' => $request->profesional_id,
            'prox' => $request->prox,
            'personal' => $request->personal,
            'apetito' => $request->apetito,
            'sed' => $request->sed,
            'card' => $request->card,
            'animo' => $request->animo,
            'deposiciones' => $request->deposiciones,
            'orina' => $request->orina


    	]);

    	return back();

    }
}
