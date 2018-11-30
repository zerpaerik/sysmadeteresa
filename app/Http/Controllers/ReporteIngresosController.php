<?php
namespace App\Http\Controllers;
/**
 * 
 */
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use Auth;
use Toastr;

class ReporteIngresosController extends Controller
{
	
	public function indexa(){
        $total = 0;
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $atenciones = $this->elasticSearch($inicio,$final,'','');
        
        foreach ($atenciones as $aten) {
          $total = $total + $aten->abono;
        }

        return view('reportes.general_atenciones.index', ["atenciones" => $atenciones, "total" => $total]);
	}

    public function searcha(Request $request)
    {
      $search = $request->nom;
      $split = explode(" ",$search);
      $total = 0;

      if (!isset($split[1])) {
       
        $split[1] = '';
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]);
        foreach ($atenciones as $aten) {
          $total = $total + $aten->abono;
        }
        return view('reportes.general_atenciones.search', ["atenciones" => $atenciones,"total" => $total]); 

      }else{
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]); 
        foreach ($atenciones as $aten) {
          $total =  $total + $aten->abono; 
        } 
        return view('reportes.general_atenciones.search', ["atenciones" => $atenciones, "total" => $total]);   
      }    
    }

  private function elasticSearch($initial, $final,$nom,$ape)
  { 
        $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.pendiente','a.abono','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','c.por_tec','e.name','e.lastname','d.name as laboratorio')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
       // ->join('profesionales as f','f.id','a.origen_usuario')
        ->where('b.nombres','like','%'.$nom.'%')
        ->where('b.nombres','like','%'.$ape.'%')
        ->whereNotIn('a.monto',[0,0.00])
        ->whereNotIn('a.porcentaje',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        //->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($final)), date('Y-m-d 23:59:59', strtotime($final))])
        ->orderby('a.id','desc')
        ->paginate(20);
        return $atenciones;
  }

    public function indexe(){
        $total = 0;
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $atenciones = $this->elasticSearche($inicio,$final,'','');
        
        foreach ($atenciones as $aten) {
          $total = $total + $aten->monto;
        }

        return view('reportes.general_egresos.index', ["atenciones" => $atenciones, "total" => $total]);
  }

    public function searche(Request $request)
    {
      $search = $request->nom;
      $split = explode(" ",$search);
      $total = 0;

      if (!isset($split[1])) {
       
        $split[1] = '';
        $atenciones = $this->elasticSearche($request->inicio,$request->final,$split[0],$split[1]);
        foreach ($atenciones as $aten) {
          $total = $total + $aten->monto;
        }
        return view('reportes.general_egresos.search', ["atenciones" => $atenciones,"total" => $total]); 

      }else{
        $atenciones = $this->elasticSearche($request->inicio,$request->final,$split[0],$split[1]); 
        foreach ($atenciones as $aten) {
          $total =  $total + $aten->monto; 
        } 
        return view('reportes.general_egresos.search', ["atenciones" => $atenciones, "total" => $total]);   
      }    
    }

  private function elasticSearche($initial, $final,$nom,$ape)
  { 
        $atenciones = DB::table('debitos as a')
        ->select('a.id','a.descripcion','a.monto','a.origen','a.created_at')
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        //->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($final)), date('Y-m-d 23:59:59', strtotime($final))])
        ->orderby('a.id','desc')
        ->paginate(20);
        return $atenciones;
  }

 
}