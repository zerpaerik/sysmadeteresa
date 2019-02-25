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
	
	public function index(Request $request){

       if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


   $atenciones = DB::table('atenciones as a')
   ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.monto','a.pendiente','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
   ->join('pacientes as b','b.id','a.id_paciente')
   ->join('servicios as c','c.id','a.id_servicio')
   ->join('analises as d','d.id','a.id_laboratorio')
   ->join('users as e','e.id','a.origen_usuario')
   //->whereBetween('a.created_at', [$f1, $f2])
   ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
   ->where('a.id_sede','=', $request->session()->get('sede'))
   ->where('a.pago_com_tec','=', 0)
   ->whereNotIn('a.porcentaje',[0,0.00])
   ->whereNotIn('a.monto',[0,0.00])
   ->whereNotIn('a.origen_usuario',[99999999])
   ->where('a.pendiente','=',0)
   ->where('a.pagado_com','=', NULL)
   ->orderby('a.id','desc')
   ->get();


 }else{

  $atenciones = DB::table('atenciones as a')
   ->select('a.id','a.id_paciente','a.created_at','pago_com_tec','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.monto','a.pendiente','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
   ->join('pacientes as b','b.id','a.id_paciente')
   ->join('servicios as c','c.id','a.id_servicio')
   ->join('analises as d','d.id','a.id_laboratorio')
   ->join('users as e','e.id','a.origen_usuario')
   ->where('a.id_sede','=', $request->session()->get('sede'))
    ->where('a.pago_com_tec','=', 0)
       ->whereNotIn('a.porcentaje',[0,0.00])
   ->whereNotIn('a.monto',[0,0.00])
   ->whereNotIn('a.origen_usuario',[99999999])
   ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
   ->where('a.pendiente','=',0)
   ->where('a.pagado_com','=', NULL)
   ->orderby('a.id','desc')
   ->get();


 }
         
        return view('movimientos.comporpagartec.index', ["atenciones" => $atenciones]);
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