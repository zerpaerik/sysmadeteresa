<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use App\Models\ResultadosServicios;
use App\Models\ResultadosLaboratorios;
use PDF;
use Auth;


class ReportesController extends Controller

{

	 public function verResultado($id){
       
                $searchtipo = DB::table('atenciones as a')
                ->select('a.id','a.es_servicio','a.es_laboratorio','a.resultado')
                ->where('a.resultado','=',1)
                ->where('a.id','=', $id)
                ->get();
           
           foreach ($searchtipo as $tipo) {
                    $es_servicio = $tipo->es_servicio;
                    $es_laboratorio = $tipo->es_laboratorio;
                }



                if (!is_null($es_servicio)) {

                $resultado = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.resultado','a.id_servicio','b.name as nompac','b.lastname as apepac','c.nombres','c.apellidos','d.descripcion','e.detalle')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('resultados_servicios as d','d.id_atencion','a.id')
                ->join('servicios as e','e.id','a.id_servicio')
                ->where('a.resultado','=',1)
                ->where('a.id','=', $id)
                ->get();

                } else {

                $resultado = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.resultado','a.id_laboratorio','b.name as nompac','b.lastname as apepac','c.nombres','c.apellidos','d.descripcion','e.name as detalle')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('resultados_laboratorios as d','d.id_atencion','a.id')
                ->join('analises as e','e.id','a.id_laboratorio')
                ->where('a.resultado','=',1)
                ->where('a.id','=', $id)
                ->get();


                }

        if(!is_null($resultado)){
            return $resultado;
         }else{
            return false;
         }  

     }



       public function resultados_ver($id) 
    {
       
     $resultados =ReportesController::verResultado($id);

     $view = \View::make('reportes.resultados_ver')->with('resultados', $resultados);
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);
     
       
        return $pdf->stream('resultados_ver');

    }

    public function relacion_ingreso_egreso()
    {
        $atenciones = Creditos::where('origen', 'ATENCIONES')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime('21-10-2018')), date('Y-m-d 23:59:59', strtotime('21-10-2018'))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }

        $consultas = Creditos::where('origen', 'CONSULTAS')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime('21-10-2018')), date('Y-m-d 23:59:59', strtotime('21-10-2018'))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime('21-10-2018')), date('Y-m-d 23:59:59', strtotime('21-10-2018'))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime('21-10-2018')), date('Y-m-d 23:59:59', strtotime('21-10-2018'))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }

        $egresos = Debitos::whereBetween('created_at', [date('Y-m-d', strtotime('28-10-2018')), date('Y-m-d', strtotime('28-10-2018'))])
                            ->select(DB::raw('origen, descripcion, monto'))
                            ->get();

        // dd($servicios);
        return view('reportes.diario', compact('atenciones', 'consultas','otros_servicios', 'cuentasXcobrar', 'egresos'));

    }
}


