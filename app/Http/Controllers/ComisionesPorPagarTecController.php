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
use Auth;
use Toastr;
class ComisionesPorPagarTecController extends Controller
{
	
	public function index(){
        $total = 0;
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $atenciones = $this->elasticSearch($inicio,$final,'','');
        
        foreach ($atenciones as $aten) {
          $total = $total + ($aten->monto * $aten->por_tec / 100); 
        }

        return view('movimientos.comporpagartec.index', ["atenciones" => $atenciones, "total" => $total]);
	}

    public function search(Request $request)
    {
      $search = $request->nom;
      $split = explode(" ",$search);
      $total = 0;

      if (!isset($split[1])) {
       
        $split[1] = '';
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]);
        foreach ($atenciones as $aten) {
          $total = $total + ($aten->monto * $aten->por_tec / 100); 
        }
        return view('movimientos.comporpagartec.search', ["atenciones" => $atenciones,"total" => $total]); 

      }else{
        $atenciones = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]); 
        foreach ($atenciones as $aten) {
          $total =  $total + ($aten->monto * $aten->por_tec / 100); 
        } 
        return view('movimientos.comporpagartec.search', ["atenciones" => $atenciones, "total" => $total]);   
      }    
    }

	public function pagarcom($id) {
          $last = Atenciones::select('recibo')->orderby('recibo', 'DESC')->first();
          if (!empty($last->recibo)) {
            $last = explode("-", $last->recibo);
            $last = array_pop($last);
          } else {
            $last = 0;
          }

          Atenciones::where('id', $id)
                  ->update([
                      'pago_com_tec' => 1,
                      'recibo' => 'REC'.date('Y').'-'.str_pad($last+1, 4, "0", STR_PAD_LEFT)
                  ]);
	    Toastr::success('La comisión ha sido pagada.', 'Comisiones!', ['progressBar' => true]);
	    return redirect()->route('comporpagartec.index');
	 }

  private function elasticSearch($initial, $final,$nom,$ape)
  { 
        $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','c.por_tec','e.name','e.lastname','d.name as laboratorio')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
       // ->join('profesionales as f','f.id','a.origen_usuario')
        ->where('a.pago_com_tec','=', 0)
        ->where('a.es_servicio','=', 1)
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

  public function pagarmultiple(Request $request)
  {
    if(isset($request->com)){
      $last = Atenciones::select('recibo')->orderby('recibo', 'DESC')->first();
      if (!empty($last->recibo)) {
        $last = explode("-", $last->recibo);
        $last = array_pop($last);
      } else {
        $last = 0;
      }

      $recibo = 'REC'.date('Y').'-'.str_pad($last+1, 4, "0", STR_PAD_LEFT);
      
      foreach ($request->com as $atencion) {
        Atenciones::where('id', $atencion)
                  ->update([
                      'pago_com_tec' => 1,
                      'recibo' => $recibo
                  ]);
      }

      Toastr::success('Las comisiones han sido pagadas.', 'Comisiones!', ['progressBar' => true]);
    } 

    return redirect()->route('comporpagartec.index');
  }
}