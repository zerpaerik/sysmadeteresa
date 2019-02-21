<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Historiales;
use App\Models\LaboratoriosPagados;
use Auth;


class LabporPagarController extends Controller

{

	public function index(Request $request){


        $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.created_at','a.id_sede','a.origen','a.es_laboratorio','a.id_laboratorio','a.monto','a.pagado_lab','a.porcentaje','a.abono','b.nombres','b.apellidos','e.name','e.lastname','c.name as nombreana','c.costlab as costo','c.laboratorio','f.name as nombrelab')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('laboratorios as f','f.id','c.laboratorio')
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_laboratorio','=',1)
        ->where('a.pagado_lab','=',NULL)
        ->whereNotIn('a.id_laboratorio',[1])
        ->whereNotIn('c.costlab',[0])      
        ->orderby('a.id','desc')
        ->paginate(20000000);
        
        return view('movimientos.labporpagar.index', ["atenciones" => $atenciones]);
	}

    public function search(Request $request){ 
        $search = $request->nom;
        $split = explode(" ",$search);
        if (!isset($split[1])) {

            $split[1] = '';
            $atenciones = $this->elasticSearch($request,$split[0],$split[1]);
            return view('movimientos.labporpagar.search', ["atenciones" => $atenciones]);
          
        }else{
            $atenciones = $this->elasticSearch($request,$split[0],$split[1]);  
            return view('movimientos.labporpagar.search', ["atenciones" => $atenciones]);            
        }   
    }

	

  public function pagar($id, Request $request) {

       $searchAtencion = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.id_laboratorio','a.monto','a.pagado_lab','a.porcentaje','a.abono')
        ->where('a.id','=', $id)
        ->get();

         foreach ($searchAtencion as $atencion) {
                    $monto = $atencion->monto;
                    $id_laboratorio = $atencion->id_laboratorio;
                    $paciente= $atencion->id_paciente;
                }

        $searchAnalisis =  DB::table('analises as a')
        ->select('a.id','a.costlab','a.name','a.laboratorio')
        ->where('a.id','=', $id_laboratorio)
        ->get(); 


            


        foreach ($searchAnalisis as $analisis) {
                    $costo = $analisis->costlab;
                    $name = $analisis->name;
                    $laboratorio = $analisis->laboratorio;
                } 

                $pagarlab = Atenciones::findOrFail($id);
                $pagarlab->pagado_lab = 1;
                $pagarlab->update();

                $debitos = new Debitos();
                $debitos->origen = 'LAB POR PAGAR';
                $debitos->monto= $costo;
                $debitos->descripcion = $name;
                $debitos->id_sede = $request->session()->get('sede');
                $debitos->save();  

              


                $pagados = new LaboratoriosPagados();
                $pagados->laboratorio = $laboratorio;
                $pagados->analisis = $id_laboratorio;
                $pagados->monto= $costo;
                $pagados->gasto= $debitos->id;
                $pagados->atencion= $id;
                $pagados->paciente= $paciente;
                $pagados->usuario = \Auth::user()->id;
                $pagados->sede = $request->session()->get('sede');
                $pagados->save();                   

    return redirect()->route('labporpagar.index');

  }
  private function elasticSearch(Request $request,$nom,$ape)
  {
        $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.created_at','a.id_sede','a.origen','a.es_laboratorio','a.id_laboratorio','a.monto','a.pagado_lab','a.porcentaje','a.abono','b.nombres','b.apellidos','e.name','e.lastname','c.name as nombreana','c.costlab as costo','c.laboratorio','f.name as nombrelab')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('laboratorios as f','f.id','c.laboratorio')
		->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_laboratorio','=',1)
        ->where('a.pagado_lab','=',NULL)
		->whereNotIn('a.id_laboratorio',[1])
        ->whereNotIn('c.costlab',[0])
        ->where('a.id_sede','=', \Session::get("sede"))
        ->where('b.nombres','like','%'.$nom.'%')
        ->where('b.apellidos','like','%'.$ape.'%')        
        ->orderby('a.id','desc')
        ->paginate(20);

        return $atenciones;
  }  
}
