<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use Auth;


class ComporPagarController extends Controller

{

	public function index(){


      	
      	$atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.porc_pagar','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio','f.name as nompro','f.apellidos as apepro')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('profesionales as f','f.id','a.origen_usuario')
        ->where('a.pagado_com','=', NULL)
        ->orderby('a.id','desc')
        ->paginate(5000);


        return view('movimientos.comporpagar.index', ["atenciones" => $atenciones]);
	}

	public function pagarcom($id, Request $request) {

       $searchAtencion = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.es_laboratorio','a.es_servicio','a.origen','a.id_laboratorio','a.id_servicio','a.monto','a.pagado_lab','a.porcentaje','a.abono')
        ->where('a.id','=', $id)
        ->get();

         foreach ($searchAtencion as $atencion) {
                    $monto = $atencion->monto;
                    $es_servicio = $atencion->es_servicio;
                    $es_laboratorio = $atencion->es_laboratorio;
                    $id_laboratorio = $atencion->id_laboratorio;
                    $id_servicio = $atencion->id_servicio;
                    $porcentaje = $atencion->porcentaje;
                }


                $pagarlab = Atenciones::findOrFail($id);
                $pagarlab->pagado_com = 1;
                $pagarlab->update();

                $debitos = new Debitos();
                $debitos->origen = 'COMISION POR PAGAR';
                $debitos->monto= $porcentaje;
                $debitos->id_sede = $request->session()->get('sede');
                $debitos->descripcion = 'COMISION POR PAGAR';
                $debitos->save();     
     

    return redirect()->route('comporpagar.index');

  }



    //
}
