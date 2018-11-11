<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use Auth;


class LabporPagarController extends Controller

{

	public function index(){
        
        $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.es_laboratorio','a.id_laboratorio','a.monto','a.pagado_lab','a.porcentaje','a.abono','b.nombres','b.apellidos','e.name','e.lastname','c.name as nombreana','c.costlab as costo','c.laboratorio','f.name as nombrelab')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('laboratorios as f','f.id','c.laboratorio')
        ->where('a.es_laboratorio','=',1)
        ->where('a.pagado_lab','=',NULL)
        ->whereNotIn('c.costlab',[0])
        ->where('a.id_sede','=', \Session::get("sede"))
        ->orderby('a.id','desc')
        ->get();

       // dd($atenciones);
        //die();


        return view('movimientos.labporpagar.index', ["atenciones" => $atenciones]);
	}

 

	public function pagar($id, Request $request) {

       $searchAtencion = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.origen','a.id_laboratorio','a.monto','a.pagado_lab','a.porcentaje','a.abono')
        ->where('a.id','=', $id)
        ->get();

         foreach ($searchAtencion as $atencion) {
                    $monto = $atencion->monto;
                    $id_laboratorio = $atencion->id_laboratorio;
                }

        $searchAnalisis =  DB::table('analises as a')
        ->select('a.id','a.costlab','a.name')
        ->where('a.id','=', $id_laboratorio)
        ->get(); 

        foreach ($searchAnalisis as $analisis) {
                    $costo = $analisis->costlab;
                    $name = $analisis->name;
                } 

                $pagarlab = Atenciones::findOrFail($id);
                $pagarlab->pagado_lab = 1;
                $pagarlab->update();

                $debitos = new Debitos();
                $debitos->origen = 'LAB POR PAGAR';
                $debitos->monto= $costo;
                $debitos->id_sede = $request->session()->get('sede');
                $debitos->descripcion = $name;
                $debitos->save();     

    return redirect()->route('labporpagar.index');

  }





    //
}
