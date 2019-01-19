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


class CajaController extends Controller
{
    public function index(Request $request)
    {
    	$totalIngresos = $this->totalIngresos($request);

    	$caja = DB::table('cajas')
    	->select('*')
    	->where('fecha','=',Carbon::now()->toDateString())
    	->where('id_sede','=', $request->session()->get('sede'))
    	->get();
    	
    	if (count($caja) == 0) {
    		$mensaje = 'Matutino';
    	}

    	if(count($caja) >= 1)
    	{
    		$mensaje = 'Vespertino';
    	}
	    return view('caja.index',[
	    	'total' => $totalIngresos,
	    	'mensaje' => $mensaje,
	    	'caja' => $caja,
	    ]);    	
    }

    public function create(Request $request)
    {
    	$caja = DB::table('cajas')
    	->select('*')
    	->where('fecha','=',Carbon::now()->toDateString())
    	->where('id_sede','=', $request->session()->get('sede'))
    	->get();

    	if (count($caja) == 0) {
    		Caja::create([
    			'cierre_matutino' => $request->total,
    			'cierre_vespertino' => 0,
    			'fecha' => Carbon::now()->toDateString(),
    			'balance' => $request->total,
    			'id_sede' =>  $request->session()->get('sede')
    		]);
    	}

    	if(count($caja) == 1)
    	{
    		 Caja::create([
    			'cierre_matutino' => 0,
    			'cierre_vespertino' => $request->total - $caja[0]->cierre_matutino,
    			'fecha' => Carbon::now()->toDateString(),
    			'balance' => $request->total,
    			'id_sede' =>  $request->session()->get('sede')
    		]);
    	}
    	return redirect('/cierre-caja');

    }

    private function totalIngresos(Request $request)
    {
        $atenciones = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime(Carbon::now()->toDateString())), date('Y-m-d 23:59:59', strtotime(Carbon::now()->toDateString()))])
									->whereNotIn('monto',[0,0.00,99999])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(abono) as monto'))
                                    ->first();
        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }
		
	

        $consultas = Creditos::where('origen', 'CONSULTAS')
		                            ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime(Carbon::now()->toDateString())), date('Y-m-d 23:59:59', strtotime(Carbon::now()->toDateString()))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
		                            ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime(Carbon::now()->toDateString())), date('Y-m-d 23:59:59', strtotime(Carbon::now()->toDateString()))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
		                             ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime(Carbon::now()->toDateString())), date('Y-m-d 23:59:59', strtotime(Carbon::now()->toDateString()))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }

        $egresos = Debitos::whereBetween('created_at', [date('Y-m-d', strtotime(Carbon::now()->toDateString())), date('Y-m-d', strtotime(Carbon::now()->toDateString()))])
		                    ->where('id_sede','=', $request->session()->get('sede'))
                            ->select(DB::raw('origen, descripcion, monto'))
                            ->get();

        $efectivo = Creditos::where('tipo_ingreso', 'EF')
		                    ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime(Carbon::now()->toDateString())), date('Y-m-d 23:59:59', strtotime(Carbon::now()->toDateString()))])
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso', 'TJ')
		                    ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime(Carbon::now()->toDateString())), date('Y-m-d 23:59:59', strtotime(Carbon::now()->toDateString()))])
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

        if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
        }

          $metodos = Creditos::where('origen', 'METODOS ANTICONCEPTIVOS')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime(Carbon::now()->toDateString())), date('Y-m-d 23:59:59', strtotime(Carbon::now()->toDateString()))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($metodos->cantidad == 0) {
            $metodos->monto = 0;
        }

        $totalIngresos = $atenciones->monto + $consultas->monto + $otros_servicios->monto + $cuentasXcobrar->monto + $metodos->monto;

        return $totalIngresos;

    }
}
