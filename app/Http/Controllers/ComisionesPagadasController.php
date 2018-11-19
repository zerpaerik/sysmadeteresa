<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use Auth;
use Toastr;

class ComisionesPagadasController extends Controller

{

	public function index(){
        $total = 0;
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $atenciones = $this->elasticSearch($inicio,$final);
        foreach ($atenciones as $atec) {
          $total = $total + $atec->totalrecibo;
        }
        return view('movimientos.compagadas.index', ["atenciones" => $atenciones, "total" => $total]);
	}

    public function search(Request $request)
    {
        $total = 0;
        $atenciones = $this->elasticSearch($request->inicio,$request->final);
        foreach ($atenciones as $atec) {
          $total = $total + $atec->totalrecibo;
        }
        return view('movimientos.compagadas.search', ["atenciones" => $atenciones, "total" => $total]); 
    }


  private function elasticSearch($initial, $final)
  { 
       $atenciones = DB::table('atenciones as a')
      ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.recibo','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio',DB::raw('SUM(a.porcentaje) as totalrecibo'))
      ->join('pacientes as b','b.id','a.id_paciente')
      ->join('servicios as c','c.id','a.id_servicio')
      ->join('analises as d','d.id','a.id_laboratorio')
      ->join('users as e','e.id','a.origen_usuario')
      ->where('a.pagado_com','=', 1)
      ->whereNotIn('a.monto',[0,0.00])
      ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
      ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
      ->groupBy('a.recibo')
      ->orderby('a.id','desc')
      ->paginate(20);



        return $atenciones;
  }

    public function reversar($id) {

        

          Atenciones::where('recibo', $id)
                  ->update([
                      'pagado_com' => NULL,
                      'recibo' => nULL
                  ]);
     
    Toastr::success('El pago de la comisiòn fue reversado.', 'Pago Reversado!', ['progressBar' => true]);
    return redirect()->route('compagadas.index');

  }
   
}
