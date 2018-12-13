<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consulta;
use App\Http\Requests\CreateConsultaRequest;
use Carbon\Carbon;
use DB;
use App\Models\ConsultaMateriales;
use App\Models\Existencias\{Producto, Existencia, Transferencia,Historiales};
use Toastr;


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
		$consulta->examen_fisico_regional =$request->examen_fisico_regional;
		$consulta->presuncion_diagnostica =$request->presuncion_diagnostica;
		$consulta->diagnostico_final =$request->diagnostico_final;
		$consulta->ciex =$request->ciex;
		$consulta->ciex2=$request->ciex2;
		$consulta->examen_auxiliar=$request->examen_auxiliar;
		$consulta->plan_tratamiento =$request->plan_tratamiento;
		$consulta->observaciones =$request->observaciones;
		$consulta->paciente_id =$request->paciente_id;
		$consulta->profesional_id =$request->profesional_id;
		$consulta->prox =$request->prox;
		$consulta->personal =$request->personal;
		$consulta->apetito =$request->apetito;
		$consulta->sed =$request->sed;
		$consulta->orina =$request->orina;
		$consulta->animo =$request->animo;
		$consulta->g =$request->g;
		$consulta->p =$request->p;
		$consulta->pap =$request->pap;
		$consulta->deposiciones =$request->deposiciones;
		$consulta->card =$request->card;
		$consulta->save();
		
		
	 if (isset($request->id_laboratorio)) {
      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {
          $pro = new ConsultaMateriales();
          $pro->id_consulta = $consulta->id;
          $pro->id_material =  $laboratorio['laboratorio'];
          $pro->cantidad = $request->monto_abol['laboratorios'][$key]['abono'];
          $pro->save();
		  
		  $SearchMaterial = Producto::where('id', $laboratorio['laboratorio'])
          ->first();
		  $cantactual= $SearchMaterial->cantidad;
	
		
	  $p = Producto::find($laboratorio['laboratorio']);
      $p->cantidad = $cantactual - $request->monto_abol['laboratorios'][$key]['abono'];
      $res = $p->save();
	  Toastr::success('Registrado Exitosamente.', 'Consulta!', ['progressBar' => true]);
      return redirect()->action('Events\EventController@index', ["edited" => $res]);
		  
		  
	
        } else {

        }
      }
    }


    	return back();

    }
}
