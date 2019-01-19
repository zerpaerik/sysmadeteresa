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
	    $caja = DB::table('cajas')->select('*')->where('fecha','=',Carbon::now()->toDateString())->get();
	    $aten = Atenciones::where('id_sede','=', $request->session()->get('sede'))
	                   ->whereNotIn('monto',[0,0.00])
	                   ->whereDate('created_at', '=',Carbon::today()->toDateString())
	                   ->select(DB::raw('SUM(abono) as monto'))
	                   ->first();
		$mensaje;	                   

    	if (count($caja) == 0) {
    		$mensaje = 'Matutino';
    	}

    	if(count($caja) >= 1)
    	{
    		$mensaje = 'Vespertino';
    	}
		
	    return view('caja.index',[
	    	'total' => $aten->monto,
	    	'mensaje' => $mensaje,
	    	'caja' => $caja,
	    ]);    	
    }

    public function create(Request $request)
    {
    	$caja = DB::table('cajas')->select('*')->where('fecha','=',Carbon::now()->toDateString())->get();

    	if (count($caja) == 0) {
    		Caja::create([
    			'cierre_matutino' => $request->total,
    			'cierre_vespertino' => 0,
    			'fecha' => Carbon::now()->toDateString(),
    			'balance' => $request->total
    		]);
    	}

    	if(count($caja) == 1)
    	{
    		 Caja::create([
    			'cierre_matutino' => 0,
    			'cierre_vespertino' => $request->total - $caja[0]->cierre_matutino,
    			'fecha' => Carbon::now()->toDateString(),
    			'balance' => $request->total
    		]);
    	}
    	return redirect('/cierre-caja');

    }
}
