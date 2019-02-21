<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Pacientes\Paciente;
use App\Models\Creditos;
use App\Models\Historiales;
use App\Models\HistorialCobros;
use App\Models\LaboratoriosPagados;

use Auth;


class LaboratoriosPagadosController extends Controller

{

	public function index(Request $request)
  {


  	if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;  

    $pagados = DB::table('laboratorios_pagados as a')
    ->select('a.id','a.laboratorio','a.analisis','a.monto','a.gasto','a.atencion','a.paciente','a.usuario','a.created_at','a.sede','b.name as laboratorio','d.name as analisis','e.name as nombre','e.lastname as apellido','p.nombres as nompac','p.apellidos as apepac')
    ->join('laboratorios as b','b.id','a.laboratorio')
    ->join('analises as d','d.id','a.analisis')
    ->join('users as e','e.id','a.usuario')
    ->join('pacientes as p','p.id','a.paciente')
    ->where('a.sede','=', $request->session()->get('sede'))
    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
    ->orderby('a.id','desc')
    ->get(); 

} else {

	  $pagados = DB::table('laboratorios_pagados as a')
    ->select('a.id','a.laboratorio','a.analisis','a.monto','a.gasto','a.atencion','a.paciente','a.usuario','a.created_at','a.sede','b.name as laboratorio','d.name as analisis','e.name as nombre','e.lastname as apellido','p.nombres as nompac','p.apellidos as apepac')
    ->join('laboratorios as b','b.id','a.laboratorio')
    ->join('analises as d','d.id','a.analisis')
    ->join('users as e','e.id','a.usuario')
    ->join('pacientes as p','p.id','a.paciente')
    ->where('a.sede','=', $request->session()->get('sede'))
    ->orderby('a.id','desc')
    ->get(); 



}

        return view('movimientos.labpagados.index', ['pagados' => $pagados]); 
	}


    public function reversar($id){

        $pagado= LaboratoriosPagados::where('id','=',$id)->first();

        $debitos= Debitos::where('id','=',$pagado->gasto)->first();
        $debitos->delete();

        $atencion = Atenciones::where('id','=',$pagado->atencion)->first();
        $atencion->pagado_lab= NULL;
        $atencion->save();

        $pagadod= LaboratoriosPagados::where('id','=',$id)->first();
        $pagadod->delete();

           return redirect()->route('labpagados.index');



    }



	

}
