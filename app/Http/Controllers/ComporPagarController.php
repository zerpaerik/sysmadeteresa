<?php

/*namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Historiales;
use Auth;
use Toastr;

class ComporPagarController extends Controller

{

	public function index(Request $request){
        $total = 0;
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $atenciones = $this->elasticSearch($request,$inicio,$final,'','');
        foreach ($atenciones as $aten) {
          $total = $total + $aten->porcentaje; 
        }
        return view('movimientos.comporpagar.index', ["atenciones" => $atenciones, "total" => $total]);
	}

    public function search(Request $request)
    {
      $search = $request->nom;
      $split = explode(" ",$search);
      $total = 0;

      if (!isset($split[1])) {
       
        $split[1] = '';
        $atenciones = $this->elasticSearch($request,$request->inicio,$request->final,$split[0],$split[1]);
        foreach ($atenciones as $aten) {
          $total = $total + $aten->porcentaje; 
        }
        return view('movimientos.comporpagar.search', ["atenciones" => $atenciones,"total" => $total]); 

      }else{
        $atenciones = $this->elasticSearch($request,$request->inicio,$request->final,$split[0],$split[1]); 
        foreach ($atenciones as $aten) {
          $total = $total + $aten->porcentaje; 
        } 
        return view('movimientos.comporpagar.search', ["atenciones" => $atenciones, "total" => $total]);   
      }    
    }

	public function pagarcom($id, Request $request) {

          $last = Atenciones::select('recibo')->orderby('recibo', 'DESC')->first();
          if (!empty($last->recibo)) {
            $last = explode("-", $last->recibo);
            $last = array_pop($last);
          } else {
            $last = 0;
          }

          Atenciones::where('id', $id)
                  ->update([
                      'pagado_com' => 1,
                      'recibo' => 'REC'.date('Y').'-'.str_pad($last+1, 4, "0", STR_PAD_LEFT)
                  ]);
				  
		  $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Comisiones por Pagar';
		  $historial->detalle ='Comision Por Pagar';
          $historial->id_usuario = \Auth::user()->id;
		  $historial->sede = $request->session()->get('sede');
          $historial->save();
     
    Toastr::success('La comisión ha sido pagada.', 'Comisiones!', ['progressBar' => true]);
    return redirect()->route('comporpagar.index');

  }

  private function elasticSearch(Request $request,$initial, $final,$nom,$ape)
  { 
        $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.created_at','a.id_sede','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.monto','a.porcentaje','a.pendiente','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
       // ->join('profesionales as f','f.id','a.origen_usuario')
	    // ->where('a.id_sede','=', $request->session()->get('sede'))
	    ->whereNotIn('a.monto',[0,0.00])
	    ->whereNotIn('a.porcentaje',[0,0.00])
	     ->whereNotIn('a.porc_pagar',[0,0.00])
		 ->whereNotIn('a.pendiente','>',0)
        ->where('a.pagado_com','=', NULL)
        ->where('e.name','like','%'.$nom.'%')
        ->where('e.lastname','like','%'.$ape.'%')
        ->whereNotIn('a.monto',[0,0.00])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($final)), date('Y-m-d 23:59:59', strtotime($final))])
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
                      'pagado_com' => 1,
                      'recibo' => $recibo
                  ]);
      }

      Toastr::success('Las comisiones han sido pagadas.', 'Comisiones!', ['progressBar' => true]);
    } 

    return redirect()->route('comporpagar.index');
  }
       
   
}*/



namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Historiales;
use Auth;
use Toastr;

class ComporPagarController extends Controller

{

	public function index(Request $request){

      if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


   $atenciones = DB::table('atenciones as a')
   ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.pago_com_tec','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_paquete','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.monto','a.pendiente','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','p.detalle as paquete')
   ->join('pacientes as b','b.id','a.id_paciente')
   ->join('servicios as c','c.id','a.id_servicio')
   ->join('analises as d','d.id','a.id_laboratorio')
   ->join('users as e','e.id','a.origen_usuario')
   ->join('paquetes as p','p.id','a.id_paquete')
   //->whereBetween('a.created_at', [$f1, $f2])
   ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
   ->where('a.id_sede','=', $request->session()->get('sede'))
   ->where('a.pago_com_tec','=',NULL)
   ->whereNotIn('a.monto',[0,0.00,99999])
   ->whereNotIn('a.origen_usuario',[99999999])
   ->where('a.pendiente','=',0)
   ->where('a.pagado_com','=', NULL)
   ->orderby('a.id','desc')
   ->paginate(20000);

   $aten = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                                    ->whereNotIn('monto',[0,0.00])
                                     ->whereNotIn('origen_usuario',[99999999])
                                     ->where('pendiente','=',0)
                                     ->where('pagado_com','=', NULL)
                                    ->select(DB::raw('SUM(porcentaje) as monto'))
                                    ->first();
        if ($aten->monto == 0) {
        }

 }else{

  $atenciones = DB::table('atenciones as a')
   ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.pago_com_tec','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.es_paquete','a.id_paquete','a.es_servicio','a.es_laboratorio','a.monto','a.pendiente','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','p.detalle as paquete')
   ->join('pacientes as b','b.id','a.id_paciente')
   ->join('servicios as c','c.id','a.id_servicio')
   ->join('analises as d','d.id','a.id_laboratorio')
    ->join('paquetes as p','p.id','a.id_paquete')
   ->join('users as e','e.id','a.origen_usuario')
   ->where('a.id_sede','=', $request->session()->get('sede'))
    ->where('a.pago_com_tec','=',NULL)
   ->whereNotIn('a.monto',[0,0.00,99999])
   ->whereNotIn('a.origen_usuario',[99999999])
   ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
   ->where('a.pendiente','=',0)
   ->where('a.pagado_com','=', NULL)
   ->orderby('a.id','desc')
   ->paginate(20000);

    $aten = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                      ->whereNotIn('monto',[0,0.00])
                      ->whereNotIn('origen_usuario',[99999999])
                      ->where('pendiente','=',0)
                      ->where('pagado_com','=', NULL)
                      ->whereDate('created_at', '=',Carbon::today()->toDateString())
                      ->select(DB::raw('SUM(porcentaje) as monto'))
                      ->first();
        if ($aten->monto == 0) {
        }






 }
       
        return view('movimientos.comporpagar.index', ['atenciones' => $atenciones,'aten' => $aten]);
	}

   

	public function pagarcom($id, Request $request) {

          $last = Atenciones::select('recibo')->orderby('recibo', 'DESC')->first();
          if (!empty($last->recibo)) {
            $last = explode("-", $last->recibo);
            $last = array_pop($last);
          } else {
            $last = 0;
          }

          Atenciones::where('id', $id)
                  ->update([
                      'pagado_com' => 1,
                      'recibo' => 'REC'.date('Y').'-'.str_pad($last+1, 4, "0", STR_PAD_LEFT)
                  ]);
				  
		  $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Comisiones por Pagar';
		  $historial->detalle ='Comision Por Pagar';
          $historial->id_usuario = \Auth::user()->id;
          $historial->save();
     
    Toastr::success('La comisión ha sido pagada.', 'Comisiones!', ['progressBar' => true]);
    return redirect()->route('comporpagar.index');

  }

  private function elasticSearch($initial, $final,$nom,$ape,Request $request)
  { 
        $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.created_at','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.monto','a.pendiente','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
       // ->join('profesionales as f','f.id','a.origen_usuario')
	    ->where('a.id_sede','=', $request->session()->get('sede'))
	    ->whereNotIn('a.monto',[0,0.00])
		->whereNotIn('a.origen_usuario',[99999999])
		->where('a.pendiente','=',0)
        ->where('a.pagado_com','=', NULL)
        ->where('e.name','like','%'.$nom.'%')
        ->where('e.lastname','like','%'.$ape.'%')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
       // ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($final)), date('Y-m-d 23:59:59', strtotime($final))])
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
                      'pagado_com' => 1,
                      'recibo' => $recibo
                  ]);
      }

      Toastr::success('Las comisiones han sido pagadas.', 'Comisiones!', ['progressBar' => true]);
    } 

    return redirect()->route('comporpagar.index');
  }
       
   
}

