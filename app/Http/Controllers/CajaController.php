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


    	
    	
    	if (count($caja) == 0) {
    		$mensaje = 'Matutino';
    	}

    	if(count($caja) >= 1)
    	{
    		$mensaje = 'Vespertino';
    	}

        }
		

	    return view('caja.index',[
	    	'total' => $aten,
	    	'mensaje' => $mensaje,
	    	'caja' => $caja,
	    	'fecha' => Carbon::now()->toDateString()
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
