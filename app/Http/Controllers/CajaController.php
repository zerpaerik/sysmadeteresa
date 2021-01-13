<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use App\Caja;
use Auth;
use Toastr;
use PDF;



class CajaController extends Controller
{
    public function index(Request $request)
    {

       if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;  

     // $caja = DB::table('cajas')->select('*')->where('sede','=',$request->session()->get('sede'))->whereBetween('fecha', [date('Y-m-d', strtotime($f1)), date('Y-m-d', strtotime($f2))])->get();


      $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.fecha','a.balance','a.sede','a.usuario','b.name','b.lastname','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->whereBetween('a.fecha', [date('Y-m-d', strtotime($f1)), date('Y-m-d', strtotime($f2))])
        ->where('a.sede','=',$request->session()->get('sede'))
        ->get();

        $aten = Creditos::where('id_sede','=', $request->session()->get('sede'))
                       ->whereNotIn('monto',[0,0.00])
                       ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                       ->select(DB::raw('SUM(monto) as monto'))
                       ->first();
      

        $mensaje;                      

        if (count($caja) == 0) {
            $mensaje = 'Matutino';
        }

        if(count($caja) >= 1)
        {
            $mensaje = 'Vespertino';
        }  



} else {


	 //  $caja = DB::table('cajas')->select('*')->where('sede','=',$request->session()->get('sede'))->where('fecha','=',Carbon::now()->toDateString())->get();

        $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.fecha','a.balance','a.sede','a.usuario','b.name','b.lastname','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->where('a.fecha','=',Carbon::now()->toDateString())
        ->where('a.sede','=',$request->session()->get('sede'))
        ->get();

	    $aten = Creditos::where('id_sede','=', $request->session()->get('sede'))
	                   ->whereNotIn('monto',[0,0.00])
	                   ->whereDate('created_at', '=',Carbon::today()->toDateString())
	                   ->select(DB::raw('SUM(monto) as monto'))
	                   ->first();
      

		$mensaje;	



          $f1 = Carbon::now()->toDateString();
         $f2 = Carbon::now()->toDateString(); 
    	
    	
    	if (count($caja) == 0) {
    		$mensaje = 'Matutino';
    	}

    	if(count($caja) >= 1)
    	{
    		$mensaje = 'Vespertino';
    	}

        }
		              $hoy =date('Y-m-d H:i:s');


	    return view('caja.index',[
	    	'total' => $aten,
	    	'mensaje' => $mensaje,
	    	'caja' => $caja,
	    	'fecha' => Carbon::now()->toDateString(),
            'fecha1' => $f1,
            'fecha2' => $f2,
            'hoy' => $hoy
	    ]);    	
    }
/*
    public function create(Request $request)
    {
    	
    	$caja = DB::table('cajas')
    	->select('*')
    	->where('fecha','=',Carbon::now()->toDateString())
    	->where('sede','=', $request->session()->get('sede'))
    	->get();

    	if (count($caja) == 0) {
    		Caja::create([
    			'cierre_matutino' => $request->total,
    			'cierre_vespertino' => 0,
    			'fecha' => Carbon::now()->toDateString(),
    			'balance' => $request->total,
                'usuario' => Auth::user()->id,
    			'sede' =>  $request->session()->get('sede')
    		]);
    	}

    	if(count($caja) == 1)
    	{
    		 Caja::create([
    			'cierre_matutino' => 0,
    			'cierre_vespertino' => $request->total - $caja[0]->cierre_matutino,
    			'fecha' => Carbon::now()->toDateString(),
    			'balance' => $request->total,
                'usuario' => Auth::user()->id,
    			'sede' =>  $request->session()->get('sede')
    		]);
    	}
    	return redirect('/cierre-caja');

    }*/



     public function saldo(Request $request,$id){

        $caja=Caja::where('fecha','=',Carbon::now()->toDateString())->where('sede','=',$request->session()->get('sede'))->first();

        if($caja){
        $fechamañana=$caja->created_at; 

        $fechanoche=date('Y-m-d H:i:s');
        

         $atenciones = Creditos::where('origen', 'ATENCIONES')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereNotIn('monto',[0,0.00,99999])
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
             


        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }

     


         $consultas = Creditos::where('origen','CONSULTAS')
                                     ->where('id_sede','=', $request->session()->get('sede'))
                                      ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                      ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                       ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }

          $metodos = Creditos::where('origen', 'METODOS ANTICONCEPTIVOS')
                                             ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($metodos->cantidad == 0) {
            $metodos->monto = 0;
        }


         $ventas = Creditos::where('origen','VENTA DE PRODUCTOS')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($ventas->cantidad == 0) {
            $ventas->monto = 0;
        }


        $egresos = Debitos::whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                            ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereIn('tipo',['CAJA','RETIRO'])
                            ->select(DB::raw('origen, descripcion, monto,tipo'))
                            ->get();


        $efectivo = Creditos::where('tipo_ingreso','EF')
                            ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso','TJ')
                            ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fechanoche))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

        if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
        }

         $totalEgresos = 0;

        foreach ($egresos as $egreso) {
            $totalEgresos += $egreso->monto;
        }
    
         $totalIngresos = $atenciones->monto + $consultas->monto + $otros_servicios->monto + $cuentasXcobrar->monto + $ventas->monto + $metodos->monto;


        }else{

            $fecha= Carbon::now()->toDateString();


            $atenciones = Creditos::where('origen', 'ATENCIONES')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereDate('created_at','=',$fecha)
                                    ->whereNotIn('monto',[0,0.00])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();

                                    
        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }

        $consultas = Creditos::where('origen', 'CONSULTAS')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereDate('created_at','=',$fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereDate('created_at','=',$fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
                                            ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereDate('created_at','=',$fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }
        
         $ventas = Creditos::where('origen', 'VENTA DE PRODUCTOS')
                                             ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereDate('created_at','=',$fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($ventas->cantidad == 0) {
            $ventas->monto = 0;
        }

          $metodos = Creditos::where('origen', 'METODOS ANTICONCEPTIVOS')
                                             ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereDate('created_at','=',$fecha)
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($metodos->cantidad == 0) {
            $metodos->monto = 0;
        }

       

        $egresos = Debitos::whereDate('created_at','=',$fecha)
                            ->where('id_sede','=', $request->session()->get('sede'))
                            ->select(DB::raw('origen, descripcion, monto,tipo'))
                            ->whereIn('tipo',['CAJA','RETIRO'])
                            ->get();

      

        $efectivo = Creditos::where('tipo_ingreso','=','EF')
                            ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereDate('created_at','=',$fecha)
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso','=','TJ')
                            ->where('id_sede','=', $request->session()->get('sede'))
                           ->whereDate('created_at','=',$fecha)
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

        if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
        }

        $totalIngresos = $atenciones->monto + $consultas->monto + $otros_servicios->monto + $cuentasXcobrar->monto + $ventas->monto + $metodos->monto;

        $totalEgresos = 0;

        foreach ($egresos as $egreso) {
            $totalEgresos += $egreso->monto;
        }
        }

              $hoy =date('Y-m-d H:i:s');

      return view('caja.saldo', compact('atenciones', 'consultas', 'otros_servicios','cuentasXcobrar','ventas','metodos','totalIngresos','totalEgresos','hoy','egresos','efectivo','tarjeta'));

    }

        public function create(Request $request)
    {
        $caja = DB::table('cajas')
        ->select('*')
        ->where('fecha','=',Carbon::now()->toDateString())
        ->where('sede','=', $request->session()->get('sede'))
        ->get();

      

        if (count($caja) == 0) {
            Caja::create([
                'cierre_matutino' => $request->total,
                'cierre_vespertino' => 0,
                'fecha' => Carbon::now()->toDateString(),
                'balance' => $request->total,
                'sede' =>  $request->session()->get('sede'),
                'usuario' => Auth::user()->id
            ]);
        }

        if(count($caja) == 1)
        {
             Caja::create([
                'cierre_matutino' => 0,
                'cierre_vespertino' => $request->total - $caja[0]->cierre_matutino,
                'fecha' => Carbon::now()->toDateString(),
                'balance' => $request->total,
                'sede' =>  $request->session()->get('sede'),
                'usuario' => Auth::user()->id
            ]);
        }
        return redirect('/cierre-caja');

    }

  

    public function delete($id){

    $caja = Caja::find($id);
    $caja->delete();

    Toastr::success('Reversado Exitosamente.', 'Cierre de Caja!', ['progressBar' => true]);

     return redirect()->action('CajaController@index', ["created" => true, "caja" => Caja::all()]);
    
    
  }

   
    
}
