<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use App\Models\Pacientes;
use App\Models\ResultadosServicios;
use App\Models\ResultadosMateriales;
use App\Models\ResultadosLaboratorios;
use App\Models\MaterialesMalogrados;
use App\Models\Events\Event;
use App\Models\Existencias\Producto;
use PDF;
use Auth;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Style\Font;
use HTMLtoOpenXML;
use File;

class ReportesController extends Controller

{

	 public function verResultado($id=void){
       
                $searchtipo = DB::table('atenciones as a')
                ->select('a.id','a.es_servicio','a.es_laboratorio','a.resultado')
                ->where('a.resultado','=',1)
                ->where('a.id','=', $id)
                ->first();
           
                $es_servicio = $searchtipo->es_servicio;
                $es_laboratorio = $searchtipo->es_laboratorio;


                if (!is_null($es_servicio)) {

                $resultado = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.resultado','a.id_servicio','b.name as nompac','b.lastname as apepac','c.nombres','c.apellidos','d.descripcion','e.detalle','a.created_at')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('resultados_servicios as d','d.id_atencion','a.id')
                ->join('servicios as e','e.id','a.id_servicio')
                ->where('a.resultado','=',1)
                ->where('a.id','=', $id)
                ->first();

                } else {

                $resultado = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.resultado','a.id_laboratorio','b.name as nompac','b.lastname as apepac','c.nombres','c.apellidos','d.descripcion','e.name as detalle','a.created_at')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('resultados_laboratorios as d','d.id_atencion','a.id')
                ->join('analises as e','e.id','a.id_laboratorio')
                ->where('a.resultado','=',1)
                ->where('a.id','=', $id)
                ->first();


                }

        if(!is_null($resultado)){
            return $resultado;
         }else{
            return false;
         }  

     }


    public function editar($id)
    {
        $resultados = ReportesController::verResultado($id);

        return view('resultadosguardados.editar', ["resultados" => $resultados]);
    }

     public function reportdetallado(){

        return view('reportes.general_detalle');
    }

    public function detallado(Request $request){


        $f1= $request->f1;
        $f2= $request->f2;





          $ingresos = DB::table('creditos as a')
                ->select('a.id','a.id_sede','a.date',DB::raw('SUM(monto) as monto'),DB::raw('SUM(efectivo) as efectivo'),DB::raw('SUM(tarjeta) as tarjeta'))
                ->whereBetween('a.date', [$f1,$f2])
                ->where('a.id_sede','=', $request->session()->get('sede'))
                ->whereNotIn('a.monto',[0,0.00])
                ->groupBy('a.date')
                ->get();  


        $total= Creditos::where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('date', [$f1,$f2])
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    //->groupBy('date')
                                    ->first();
         $egresos=Debitos::where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('date', [$f1,$f2])
                                    ->select(DB::raw('SUM(monto) as egreso'),'date')
                                    ->groupBy('date')
                                    ->get();
                       
                                    
        $debitos=Debitos::where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('date', [$f1,$f2])
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    //->groupBy('date')
                                    ->first();

         $saldo= $total->monto - $debitos->monto;

         //dd($egresos);




         $view = \View::make('reportes.detallado1',compact('f1','f2','ingresos','egresos','debitos','total','saldo'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('movimientos'.$request->f1.'/'.$request->f2.'.pdf');

    }

    public function historialp(Request $request)
    {

        if(!is_null($request->paciente)){

    
       $atenciones = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.usuarioinforme','a.nombreinforme','a.informe','a.resultado','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete','b.telefono','b.direccion','b.fechanac','s.name as sede')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->join('users as h','h.id','a.usuario')
    ->join('paquetes as f','f.id','a.id_paquete')
    ->join('sedes as s','s.id','a.id_sede')
    ->whereNotIn('a.monto',[0,0.00])
    ->where('a.es_delete','=',NULL)
    ->where('b.dni','=',$request->paciente)
    ->get();




    $event = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.es_delete','e.created_at','e.atendidopor','e.atendido','e.title','e.sede','e.monto','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','u.name as nomate','u.lastname as apeate','s.name as sede')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('users as u','u.id','e.atendidopor')
    ->join('sedes as s','s.id','e.sede')
    ->where('p.dni','=',$request->paciente)
    ->where('e.es_delete','=',NULL)
    ->get();

     $metodos = DB::table('metodos as a')
        ->select('a.id','a.id_paciente','a.es_delete','a.id_usuario','a.monto','a.proximo','a.sede','a.created_at','a.id_producto','a.personal','a.aplicado','c.name','c.lastname','b.nombres','b.apellidos','b.dni','b.telefono','b.dni','d.nombre as producto','s.name as sede')
        ->join('users as c','c.id','a.id_usuario')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('productos as d','d.id','a.id_producto')
        ->join('sedes as s','s.id','a.sede')
        ->where('b.dni','=',$request->paciente)
        ->where('a.es_delete','=',NULL)
        ->orderBy('a.created_at','asc')
        ->get(); 

   } else {

     $atenciones = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.informe','a.nombreinforme','a.usuarioinforme','a.es_servicio','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','b.dni','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    ->join('users as h','h.id','a.usuario')
    ->join('paquetes as f','f.id','a.id_paquete')
    ->whereNotIn('a.monto',[0,0.00,99999])
    ->where('a.id_sede','=', 9)
        ->where('a.es_delete','=',NULL)
    ->orderby('a.id','desc')
    ->get();


   


    $event = DB::table('events as e')
    ->select('e.id as EventId','e.paciente','e.es_delete','e.created_at','e.atendidopor','e.atendido','e.title','e.sede','e.monto','e.profesional','e.date','e.time','p.dni','p.direccion','p.telefono','p.fechanac','p.gradoinstruccion','p.ocupacion','p.nombres','p.apellidos','p.id as pacienteId','per.name as nombrePro','per.lastname as apellidoPro','per.id as profesionalId','u.name as nomate','u.lastname as apeate')
    ->join('pacientes as p','p.id','=','e.paciente')
    ->join('personals as per','per.id','=','e.profesional')
    ->join('users as u','u.id','e.atendidopor')
    ->where('e.sede','=',9)
    ->get();

     $metodos = DB::table('metodos as a')
        ->select('a.id','a.id_paciente','a.id_usuario','a.monto','a.proximo','a.sede','a.created_at','a.id_producto','a.personal','a.aplicado','c.name','c.lastname','b.nombres','b.apellidos','b.dni','b.telefono','b.dni','d.nombre as producto')
        ->join('users as c','c.id','a.id_usuario')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('productos as d','d.id','a.id_producto')
            ->where('a.sede','=',9)
        ->orderBy('a.created_at','asc')
        ->get(); 




   }




    if(!is_null($request->filtro)){
    $pacientes =Pacientes::where("estatus", '=', 1)->where('apellidos','like','%'.$request->filtro.'%')->orderby('apellidos','asc')->get();
    }else{
    $pacientes =Pacientes::where("estatus", '=', 9)->orderby('nombres','asc')->get();
    }

    return view('reportes.historial.pacientes',["pacientes" => $pacientes,"event" => $event,"metodos" => $metodos,"atenciones" => $atenciones]);
    }

    public function update($id,Request $request)
    {      
        $searchtipo = DB::table('atenciones as a')
        ->select('a.id','a.es_servicio','a.es_laboratorio','a.resultado')
        ->where('a.resultado','=',1)
        ->where('a.id','=', $id)
        ->first();
           
        $es_servicio = $searchtipo->es_servicio;
        $es_laboratorio = $searchtipo->es_laboratorio;

        if (!is_null($es_servicio)) {
            DB::table('resultados_servicios')
            ->where('id_atencion',$searchtipo->id)
            ->update(['descripcion' => $request->descripcion]);
            return back();

        }
        else{
            DB::table('resultados_laboratorios')
            ->where('id_atencion',$searchtipo->id)
            ->update(['descripcion' => $request->descripcion]);
            return back();
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
	
	
	 public function verTicket($id){
       
                $searchtipo = DB::table('atenciones')
                ->select('id','es_servicio','es_laboratorio','es_paquete')
                ->where('id','=', $id)
                ->first();
           
                $es_servicio = $searchtipo->es_servicio;
                $es_laboratorio = $searchtipo->es_laboratorio;
                $es_paquete = $searchtipo->es_paquete;
				
		
                if (!is_null($es_servicio)) {

                $ticket = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.ticket','a.id_servicio','b.name as nompac','b.lastname as apepac','c.nombres','c.apellidos','e.detalle','a.created_at','a.abono','a.pendiente','a.monto')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('servicios as e','e.id','a.id_servicio')
                ->where('a.id','=', $id)
                ->first();
				
			 

                } elseif(!is_null($es_laboratorio)) {

                $ticket = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.ticket','a.id_laboratorio','b.name as nompac','b.lastname as apepac','c.nombres','c.apellidos','e.name as detalle','a.created_at','a.abono','a.pendiente','a.monto')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('analises as e','e.id','a.id_laboratorio')
                ->where('a.id','=', $id)
                ->first();


                } else {
                      $ticket = DB::table('atenciones as a')
                ->select('a.id','a.id_paciente','a.origen_usuario','a.ticket','a.id_paquete','b.name as nompac','b.lastname as apepac','c.nombres','c.apellidos','e.detalle as detalle','a.created_at','a.abono','a.pendiente','a.monto')
                ->join('users as b','b.id','a.origen_usuario')
                ->join('pacientes as c','c.id','a.id_paciente')
                ->join('paquetes as e','e.id','a.id_paquete')
                ->where('a.id','=', $id)
                ->first();

                }

        if(!is_null($ticket)){
            return $ticket;
         }else{
            return false;
         }  

     }
	
	 public function ticket_ver($id) 
    {
        $ticket =ReportesController::verTicket($id);
        $view = \View::make('reportes.ticket_atencion_ver')->with('ticket', $ticket);
        $pdf = \App::make('dompdf.wrapper');
        //$pdf->setPaper('A5', 'landscape');
        //$pdf->setPaper(array(0,0,600.00,360.00));
        $pdf->setPaper(array(0,0,800.00,3000.00));
        $pdf->loadHTML($view);
        return $pdf->stream('ticket_ver');
    }

    public function formDiario()
    {
        return view('reportes.form_diario');
    }

    public function formConsolidado()
    {
        return view('reportes.form_consolidado');
    }


    public function relacion_diario(Request $request)
    {
       
        $atenciones = Creditos::where('origen', 'ATENCIONES')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereNotIn('monto',[0,0.00,99999])
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();

        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }
		
	

        $consultas = Creditos::where('origen', 'CONSULTAS')
		                            ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
		                            ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
		                             ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }

        $egresos = Debitos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
		                    ->where('id_sede','=', $request->session()->get('sede'))
                            ->select(DB::raw('origen, descripcion, monto'))
                            ->get();

        $efectivo = Creditos::where('tipo_ingreso', 'EF')
		                    ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso', 'TJ')
		                    ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

        if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
        }

          $metodos = Creditos::where('origen', 'METODOS ANTICONCEPTIVOS')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($metodos->cantidad == 0) {
            $metodos->monto = 0;
        }

        $totalIngresos = $atenciones->monto + $consultas->monto + $otros_servicios->monto + $cuentasXcobrar->monto + $metodos->monto;

        $totalEgresos = 0;

        foreach ($egresos as $egreso) {
            $totalEgresos += $egreso->monto;
        }


        $hoy=date('d-m-Y');

        $fechaconsulta=$request->fecha;

        $view = \View::make('reportes.diario', compact('atenciones', 'consultas','otros_servicios', 'cuentasXcobrar', 'egresos', 'tarjeta', 'efectivo', 'totalEgresos', 'totalIngresos','metodos','hoy','fechaconsulta'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('diario_'.$request->fecha.'.pdf');

    }


    public function verReciboProfesional($id){
       
         $reciboprofesional = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen','a.created_at','a.origen_usuario','a.porc_pagar','a.origen','a.porcentaje','a.id_servicio','es_laboratorio','a.pagado_com','a.id_laboratorio','a.es_servicio','a.es_laboratorio','a.recibo','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','d.name as laboratorio','e.name','e.lastname','d.name as laboratorio','p.detalle as paquete')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('paquetes as p','p.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.pagado_com','=', 1)
        ->where('a.recibo','=', $id)
       // ->orderby('a.id','desc')
        ->get();


        if($reciboprofesional){
            return $reciboprofesional;
         }else{
            return false;
         }  

     }

     public function verReciboProfesional2($id){
       
         $reciboprofesional2 = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.recibo','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','e.name','e.lastname','e.dni','p.centro','c.name as centroprof')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('profesionales as p','p.apellidos','e.lastname')
        ->join('centros as c','c.id','p.centro')
        ->where('a.pagado_com','=', 1)
        ->where('a.recibo','=', $id)
        ->groupBy('a.recibo')
        ->first();

        if($reciboprofesional2){
            return $reciboprofesional2;
         }else{
            return false;
         }  

     }

      public function verReciboProfesional3($id){
       
         $reciboprofesional2 = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.recibo','a.monto','a.porcentaje','a.abono','b.nombres','b.apellidos','e.name','e.lastname','e.dni')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.pagado_com','=', 1)
        ->where('a.recibo','=', $id)
        ->groupBy('a.recibo')
        ->get();

        if($reciboprofesional2){
            return $reciboprofesional2;
         }else{
            return false;
         }  

     }

    


     public function verTotalRecibo($id){


        $totalRecibo = Atenciones::where('recibo', $id)
                            ->select(DB::raw('SUM(porcentaje) as totalrecibo'))
                            ->get();
     
        if($totalRecibo){
            return $totalRecibo;
         }else{
            return false;
         }  

     }

      public function recibo_profesionales_ver($id) 
    {

       $reciboe = ReportesController::verReciboProfesional($id)->first();
       $reciboprofesional = ReportesController::verReciboProfesional($id);
       $reciboprofesional2 = ReportesController::verReciboProfesional2($id);
    $reciboprofesional3 = ReportesController::verReciboProfesional3($id);
       $totalrecibo = ReportesController::verTotalRecibo($id);

       $hoy= Carbon::today()->toDateString();

      $atencion= Atenciones::where('recibo','=',$id)->first();

     
   


       $view = \View::make('reportes.recibo_profesionales_ver')->with('reciboprofesional', $reciboprofesional)->with('reciboe', $reciboe)->with('reciboprofesional2', $reciboprofesional2)->with('reciboprofesional3', $reciboprofesional3)->with('totalrecibo', $totalrecibo)->with('hoy', $hoy)->with('atencion', $atencion);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_profesionales_ver');
    /* }else{
      return response()->json([false]);
     }*/
    }


    // cierres de caja reportes

     public function recibo_caja_ver(Request $request,$id) 
    {

    
      
      $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.id','=',$id)
        ->first();


        $fecha=$caja->created_at;
        $fechainic=date('Y-m-d H:i:s', strtotime($caja->fecha));
        $fechafin=$caja->fecha." 23:59:59";
   
        


        $atenciones = Creditos::where('origen', 'ATENCIONES')
                                    ->whereNotIn('monto',[0,0.00,99999])
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    //->whereBetween('created_at', [strtotime($fechainic),strtotime($fecha)])
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    //->where('created_at','<=',$fecha)
                                   // ->whereBetween('created_at', [$fecha, $fecha])
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
                           
                                

        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }

        $serv = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1)   
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?",array($fechainic, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_servicio','=',1)
        ->first();

      //  dd($serv);

        if ($serv->cantidad == 0) {
            $serv->monto = 0;
        }

        $ray='RAYO';
        $eco='ECO';

        $rayos = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1) 
        ->where('c.detalle','like','%'.$ray.'%')  
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?",array($fechainic, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_servicio','=',1)
        ->first();



        if ($rayos->cantidad == 0) {
            $rayos->monto = 0;
        }

         $eco = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1) 
        ->where('c.detalle','like','%'.$eco.'%')  
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?",array($fechainic, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_servicio','=',1)
        ->first();



        if ($eco->cantidad == 0) {
            $eco->monto = 0;
        }

        $otros = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.otros','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1) 
        ->where('c.otros','=',NULL)
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?",array($fechainic, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_servicio','=',1)
        ->first();


        if ($otros->cantidad == 0) {
            $otros->monto = 0;
        }


        
        $lab = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1)   
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_laboratorio','=',1)
        ->first();

      //  dd($serv);

        if ($lab->cantidad == 0) {
            $lab->monto = 0;
        }


         $paq = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1)   
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_paquete','=',1)
        ->first();

    

        if ($paq->cantidad == 0) {
            $paq->monto = 0;
        }

     



         $consultas = Creditos::where('origen', 'CONSULTAS')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }

         $metodos = Creditos::where('origen', 'METODOS ANTICONCEPTIVOS')
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($metodos->cantidad == 0) {
            $metodos->monto = 0;
        }

        $egresos = Debitos::whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                            ->where('id_sede','=', $request->session()->get('sede'))
                            ->select(DB::raw('origen, descripcion, monto'))
                            ->get();

        $efectivo = Creditos::where('tipo_ingreso', 'EF')
                            ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso', 'TJ')
                            ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

        if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
        }

         $totalEgresos = 0;

        foreach ($egresos as $egreso) {
            $totalEgresos += $egreso->monto;
        }
    
         $totalIngresos = $atenciones->monto + $consultas->monto + $otros_servicios->monto + $cuentasXcobrar->monto + $metodos->monto;

        
 
       
       $view = \View::make('reportes.cierre_caja_ver', compact('atenciones', 'consultas','otros_servicios', 'cuentasXcobrar','metodos','serv','lab','paq','caja','egresos','efectivo','tarjeta','totalEgresos','totalIngresos','rayos','eco','otros'));
      
       //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
       $pdf = \App::make('dompdf.wrapper');
       //$pdf->setPaper('A4', 'landscape');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_cierre_caja_ver');
    /* }else{
      return response()->json([false]);
     }*/
    }

    //
    public function recibo_caja_verd(Request $request,$id) 
    {

    
      
      $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.id','=',$id)
        ->first();


        $fecha=$caja->created_at;
        $fechainic=date('Y-m-d H:i:s', strtotime($caja->fecha));
        $fechafin=$caja->fecha." 23:59:59";
   
    

          $servicios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_sede','a.id_laboratorio','a.es_servicio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_servicio','=', 1)
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00,99999])
            ->where('a.es_delete','=',NULL)
        ->orderby('a.id','desc')
        ->get();

        $totalServicios = Atenciones::where('es_servicio',1)
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                     ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();


         $laboratorios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.id_sede','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.name as laboratorio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_laboratorio','=', 1)
        ->where('a.id_sede','=', $request->session()->get('sede'))
            ->where('a.es_delete','=',NULL)
         ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();

        $totalLaboratorios = Atenciones::where('es_laboratorio',1)
                                     ->where('id_sede','=', $request->session()->get('sede'))
                                     ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();

         $paquetes = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.id_sede','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as paquete','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_paquete','=', 1)
            ->where('a.es_delete','=',NULL)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();

        $totalpaquetes = Atenciones::where('es_paquete',1)
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();
       
         $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.es_delete','a.sede','a.paciente','a.monto','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('personals as c','c.id','a.profesional')
        ->where('a.sede','=', $request->session()->get('sede'))
            ->where('a.es_delete','=',NULL)
        ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->orderby('a.id','desc')
        ->get();

       

        $totalconsultas = Event::whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->where('sede','=', $request->session()->get('sede'))
                                        ->where('es_delete','=',NULL)
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();


        $otrosingresos = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.monto','a.created_at','a.id_sede')
       ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.origen','=','OTROS INGRESOS')
         ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->orderby('a.id','desc')
        ->get();

        $totalotrosingresos = Creditos::where('origen','OTROS INGRESOS')
                                     ->where('id_sede','=', $request->session()->get('sede'))
                                     ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $cuentasporcobrar = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.monto','a.created_at','a.id_atencion','b.id_paciente','b.id_servicio','b.id_laboratorio','b.id_paquete','b.es_servicio','b.es_laboratorio','b.es_paquete','c.nombres','c.apellidos','s.detalle as servicio','l.name as laboratorio','p.detalle as paquete','a.id_sede')
        ->join('atenciones as b','b.id','a.id_atencion')
        ->join('pacientes as c','c.id','b.id_paciente')
        ->join('servicios as s','s.id','b.id_servicio')
        ->join('analises as l','l.id','b.id_laboratorio')
        ->join('paquetes as p','p.id','b.id_paquete')
        ->where('a.origen','=','CUENTAS POR COBRAR')
        ->where('a.id_sede','=', $request->session()->get('sede'))
         ->whereRaw("a.created_at >= ? AND a.created_at <= ?", 
                                     array($fechainic, $fecha))
        ->orderby('a.id','desc')
        ->get();

        $totalcuentasporcobrar = Creditos::where('origen','CUENTAS POR COBRAR')
                                     ->where('id_sede','=', $request->session()->get('sede'))
                                     ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
    
     
 

        $view = \View::make('reportes.cierre_caja_verd', compact('servicios', 'totalServicios','laboratorios', 'totalLaboratorios', 'consultas', 'totalconsultas','otrosingresos','totalotrosingresos','cuentasporcobrar','totalcuentasporcobrar','paquetes','totalpaquetes','caja'));
      
       //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
       $pdf = \App::make('dompdf.wrapper');
       //$pdf->setPaper('A4', 'landscape');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_cierre_caja_ver_detallado');
    /* }else{
      return response()->json([false]);
     }*/
    }





    //

     public function recibo_caja_ver2(Request $request,$id,$fecha1=NULL,$fecha2=NULL) 
    {
      
    if(!is_null($request->fecha1)){



      $cajamañana=DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.sede','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereDate('fecha','=',$request->fecha1)
        ->first();  

      $fechamañana=$cajamañana->created_at; 

       

    } else {

        $cajamañana=DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.sede','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereDate('fecha','=',Carbon::today()->toDateString())
        ->first();  

      $fechamañana=$cajamañana->created_at;   


    }
      
      $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.sede','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.id','=',$id)
        ->first();

        $fecha=$caja->created_at;





    
        $atenciones = Creditos::where('origen', 'ATENCIONES')
                                   ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereNotIn('monto',[0,0.00,99999])
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
             

        if ($atenciones->cantidad == 0) {
            $atenciones->monto = 0;
        }

         $serv = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1)   
        ->whereRaw("a.created_at > ? AND a.created_at <= ?",array($fechamañana, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_servicio','=',1)
        ->first();

      //  dd($serv);

        if ($serv->cantidad == 0) {
            $serv->monto = 0;
        }

        $ray='RAYO';
        $eco='ECO';

        $rayos = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1) 
        ->where('c.detalle','like','%'.$ray.'%')  
        ->whereRaw("a.created_at > ? AND a.created_at <= ?",array($fechamañana, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_servicio','=',1)
        ->first();



        if ($rayos->cantidad == 0) {
            $rayos->monto = 0;
        }

         $eco = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1) 
        ->where('c.detalle','like','%'.$eco.'%')  
        ->whereRaw("a.created_at > ? AND a.created_at <= ?",array($fechamañana, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_servicio','=',1)
        ->first();



        if ($eco->cantidad == 0) {
            $eco->monto = 0;
        }

        $otros = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.otros','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1) 
        ->where('c.otros','=',NULL)
        ->whereRaw("a.created_at > ? AND a.created_at <= ?",array($fechamañana, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_servicio','=',1)
        ->first();


        if ($otros->cantidad == 0) {
            $otros->monto = 0;
        }


        
        $lab = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1)   
        ->whereRaw("a.created_at > ? AND a.created_at <= ?",array($fechamañana, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_laboratorio','=',1)
        ->first();

      //  dd($serv);

        if ($lab->cantidad == 0) {
            $lab->monto = 0;
        }


         $paq = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.es_delete','a.tipopago','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.estatus','a.pagado_com','a.informe','a.es_laboratorio','a.es_paquete','a.monto','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','h.name as user','h.lastname as userp','d.name as laboratorio','f.detalle as paquete',DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('users as h','h.id','a.usuario')
        ->join('paquetes as f','f.id','a.id_paquete')
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->where('a.estatus','=',1)   
        ->whereRaw("a.created_at > ? AND a.created_at <= ?",array($fechamañana, $fecha))
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_paquete','=',1)
        ->first();

    

        if ($paq->cantidad == 0) {
            $paq->monto = 0;
        }


    


         $consultas = Creditos::where('origen', 'CONSULTAS')
                                            ->where('id_sede','=', $request->session()->get('sede'))
                                      ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $otros_servicios = Creditos::where('origen', 'OTROS INGRESOS')
                                           ->where('id_sede','=', $request->session()->get('sede'))
                                      ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($otros_servicios->cantidad == 0) {
            $otros_servicios->monto = 0;
        }

        $cuentasXcobrar = Creditos::where('origen', 'CUENTAS POR COBRAR')
                                           ->where('id_sede','=', $request->session()->get('sede'))
                                       ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }

         $metodos = Creditos::where('origen', 'METODOS ANTICONCEPTIVOS')
                                            ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($metodos->cantidad == 0) {
            $metodos->monto = 0;
        }


        $egresos = Debitos::whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                            ->where('id_sede','=', $request->session()->get('sede'))
                            ->select(DB::raw('origen, descripcion, monto'))
                            ->get();

        $efectivo = Creditos::where('tipo_ingreso', 'EF')
                                           ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipo_ingreso', 'TJ')
                                           ->where('id_sede','=', $request->session()->get('sede'))
                            ->whereNotIn('monto',[0,0.00,99999])
                            ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

        if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
        }

         $totalEgresos = 0;

        foreach ($egresos as $egreso) {
            $totalEgresos += $egreso->monto;
        }
    
         $totalIngresos = $atenciones->monto + $consultas->monto + $otros_servicios->monto + $cuentasXcobrar->monto + $metodos->monto ;

    

        
 


       
       $view = \View::make('reportes.cierre_caja_ver', compact('atenciones', 'consultas','otros_servicios', 'cuentasXcobrar','metodos','caja','egresos','totalEgresos','totalIngresos','efectivo','tarjeta','serv','lab','paq','otros','eco','rayos'));
             $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_cierre_caja_ver');
   
    }

    //
      public function recibo_caja_ver2d(Request $request,$id,$fecha1=NULL,$fecha2=NULL) 
    {
      

  if(!is_null($request->fecha1)){



      $cajamañana=DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.sede','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereDate('fecha','=',$request->fecha1)
        ->first();  

      $fechamañana=$cajamañana->created_at; 

       

    } else {

        $cajamañana=DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.sede','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereDate('fecha','=',Carbon::today()->toDateString())
        ->first();  

      $fechamañana=$cajamañana->created_at;   


    }

      $caja = DB::table('cajas as  a')
        ->select('a.id','a.cierre_matutino','a.cierre_vespertino','a.created_at','a.fecha','a.balance','a.sede','a.usuario','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario')
        ->where('a.id','=',$id)
        ->first();

        $fecha=$caja->created_at;


        
       //
           $servicios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','a.id_sede')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_servicio','=', 1)
            ->where('a.es_delete','=',NULL)
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->orderby('a.id','desc')
        ->get();

        $totalServicios = Atenciones::where('es_servicio',1)
                ->where('id_sede','=', $request->session()->get('sede'))
                    ->where('es_delete','=',NULL)
                                     ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();

         $laboratorios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.name as laboratorio','e.name','e.lastname','a.id_sede')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_laboratorio','=', 1)
            ->where('a.es_delete','=',NULL)
        ->where('a.id_sede','=', $request->session()->get('sede'))
         ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();

        $totalLaboratorios = Atenciones::where('es_laboratorio',1)
                ->where('id_sede','=', $request->session()->get('sede'))
                                     ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();

         $paquetes = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','b.nombres','b.apellidos','c.detalle as paquete','e.name','e.lastname','a.id_sede')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_paquete','=', 1)
            ->where('a.es_delete','=',NULL)
                ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->whereNotIn('a.monto',[0,0.00])
        ->orderby('a.id','desc')
        ->get();

        $totalpaquetes = Atenciones::where('es_paquete',1)
                ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();
       
         $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.paciente','a.es_delete','a.monto','a.sede','a.date','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('personals as c','c.id','a.profesional')
        ->where('a.sede','=', $request->session()->get('sede'))
            ->where('a.es_delete','=',NULL)
        ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->orderby('a.id','desc')
        ->get();


       

        $totalconsultas = Event::whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                ->where('sede','=', $request->session()->get('sede'))
                    ->where('es_delete','=',NULL)
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $otrosingresos = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.id_sede','a.tipo_ingreso','a.monto','a.created_at')
        ->where('a.origen','=','OTROS INGRESOS')
        ->where('a.id_sede','=', $request->session()->get('sede'))
         ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->orderby('a.id','desc')
        ->get();

        $totalotrosingresos = Creditos::where('origen','OTROS INGRESOS')
                ->where('id_sede','=', $request->session()->get('sede'))
                                     ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $cuentasporcobrar = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.monto','a.created_at','a.id_atencion','b.id_paciente','b.id_servicio','b.id_laboratorio','b.id_paquete','b.es_servicio','b.es_laboratorio','b.es_paquete','c.nombres','c.apellidos','s.detalle as servicio','l.name as laboratorio','p.detalle as paquete','a.id_sede')
        ->join('atenciones as b','b.id','a.id_atencion')
        ->join('pacientes as c','c.id','b.id_paciente')
        ->join('servicios as s','s.id','b.id_servicio')
        ->join('analises as l','l.id','b.id_laboratorio')
        ->join('paquetes as p','p.id','b.id_paquete')
        ->where('a.origen','=','CUENTAS POR COBRAR')
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereRaw("a.created_at > ? AND a.created_at <= ?", 
                                     array($fechamañana, $fecha))
        ->orderby('a.id','desc')
        ->get();

        $totalcuentasporcobrar = Creditos::where('origen','CUENTAS POR COBRAR')
                ->where('id_sede','=', $request->session()->get('sede'))
                                     ->whereRaw("created_at > ? AND created_at <= ?", 
                                     array($fechamañana, $fecha))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
    
        
    
       // $fecha = $caja->fecha;

       

        $view = \View::make('reportes.cierre_caja_verd', compact('servicios', 'totalServicios','laboratorios', 'totalLaboratorios', 'consultas', 'totalconsultas','otrosingresos','totalotrosingresos','cuentasporcobrar','totalcuentasporcobrar','paquetes','totalpaquetes','caja'));


      
       //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
       $pdf = \App::make('dompdf.wrapper');
       //$pdf->setPaper('A4', 'landscape');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_cierre_caja_ver_detallado');
    /* }else{
     }*/
    }


    //

    

     public function recibo_gasto_ver(Request $request,$id) 
    {

  
     $gastos = DB::table('debitos as a')
      ->select('a.id','a.descripcion','a.monto','a.nombre','a.created_at','a.id_sede','a.usuario','b.name','b.lastname')
      ->join('users as b','b.id','a.usuario')
      ->where('a.id','=',$id)
      ->first();
       
       $view = \View::make('reportes.gastos_ver', compact('gastos'));
      
       //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->setPaper('A5', 'landscape');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_gastos_ver');
    /* }else{
     }*/
    }


    public function general_ingresos(Reques $request){


     $otrosingresos = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.id_sede','a.monto','a.created_at')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->orderby('a.id','desc')
        ->get();








    }

    public function modelo_informe($id,$informe)
    {
        File::delete(File::glob('*.docx'));
        $informe = $templateProcessor = new TemplateProcessor(public_path('modelos_informes/'.$informe));
        $resultados = ReportesController::elasticSearch($id);
        $resultados1 = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.informe','a.abono','a.resultado','b.nombres as nombrePaciente','b.apellidos as apellidoPaciente','b.fechanac','c.detalle as servicio','e.name','e.dni as dniprof','e.lastname','d.name as laboratorio','b.dni')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->whereNotIn('a.monto',[0,0.00])
        ->where('a.resultado','=', NULL)
        ->where('a.id','=',$id)
        ->first();
        
    $edad = Carbon::parse($resultados1->fechanac)->age;


        $informe->setValue('name', $resultados->apellidoPaciente. ' '.$resultados->nombrePaciente. ' Edad: '.$edad);
        $informe->setValue('descripcion',$resultados->servicio);
        $informe->setValue('date',date('d-m-Y'));        
        //dd($resultados->origen);
        if ($resultados->origen == 1) {
            $informe->setValue('indicacion','MADRE TERESA');
        }
        if ($resultados->origen == 2) {
           
            $informe->setValue('indicacion',$resultados->origen_usuario);
        }
        if ($resultados->origen == 3 ) {
            $informe->setValue('indicacion','PARTICULAR');
        }        
        $informe->saveAs($resultados->id.'-'.$resultados->nombrePaciente.'-'.$resultados->apellidoPaciente.'-'.$resultados->dni.'.docx');
        return response()->download($resultados->id.'-'.$resultados->nombrePaciente.'-'.$resultados->apellidoPaciente.'-'.$resultados->dni.'.docx');

    }

    public function relacion_detallado(Request $request)
    {

        $servicios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_servicio','a.monto','a.tipopago','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('users as e','e.id','a.origen_usuario')
        ->where('a.es_servicio','=', 1)
            ->where('a.es_delete','=',NULL)
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->where('a.id_sede','=', $request->session()->get('sede'))
         ->whereNotIn('a.monto',[0,0.00,99999])
        ->orderby('a.id','desc')
        ->get();

        $totalServicios = Atenciones::where('es_servicio',1)
		                            ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereNotIn('monto',[0,0.00,99999])
                                        ->where('es_delete','=',NULL)
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();

         $laboratorios = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.name as laboratorio','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
            ->where('a.es_delete','=',NULL)
		->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_laboratorio','=', 1)
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->where('a.id_sede','=', $request->session()->get('sede'))
         ->whereNotIn('a.monto',[0,0.00,99999])
        ->orderby('a.id','desc')
        ->get();

        $totalLaboratorios = Atenciones::where('es_laboratorio',1)
                                    ->whereNotIn('monto',[0,0.00,99999])
                                        ->where('es_delete','=',NULL)
		                            ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();
		 $paquetes = DB::table('atenciones as a')
        ->select('a.id','a.created_at','a.id_paciente','a.es_delete','a.origen_usuario','a.origen','a.id_servicio','a.id_paquete','a.id_laboratorio','a.es_laboratorio','a.monto','a.tipopago','a.porcentaje','a.abono','a.id_sede','b.nombres','b.apellidos','c.detalle as paquete','e.name','e.lastname')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->join('users as e','e.id','a.origen_usuario')
		->where('a.id_sede','=', $request->session()->get('sede'))
        ->where('a.es_paquete','=', 1)
            ->where('a.es_delete','=',NULL)
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->whereNotIn('a.monto',[0,0.00,99999])
        ->orderby('a.id','desc')
        ->get();

        $totalPaquetes = Atenciones::where('es_paquete',1)
                                     ->whereNotIn('monto',[0,0.00,99999])
                                         ->where('es_delete','=',NULL)
		                            ->where('id_sede','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('SUM(abono) as abono'))
                                    ->first();						
       
         $consultas = DB::table('events as a')
        ->select('a.id','a.profesional','a.es_delete','a.paciente','a.sede','a.monto','a.created_at','b.nombres','b.apellidos','c.name','c.lastname as apepro')
        ->join('pacientes as b','b.id','a.paciente')
        ->join('personals as c','c.id','a.profesional')
        ->where('a.es_delete','=',NULL)
        ->where('a.sede','=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->orderby('a.id','desc')
        ->get();
        

        $totalconsultas = Event::where('sede','=', $request->session()->get('sede'))
                                 ->where('es_delete','=',NULL)
                                  ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $otrosingresos = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.id_sede','a.monto','a.created_at')
        ->where('a.origen','=','OTROS INGRESOS')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->orderby('a.id','desc')
        ->get();

        $totalotrosingresos = Creditos::where('origen','OTROS INGRESOS')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

        $cuentasporcobrar = DB::table('creditos as a')
        ->select('a.id','a.origen','a.descripcion','a.tipo_ingreso','a.id_sede','a.monto','a.created_at')
        ->where('a.origen','=','CUENTAS POR COBRAR')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->where('a.id_sede','=', $request->session()->get('sede'))
        ->orderby('a.id','desc')
        ->get();

        $totalcuentasporcobrar = Creditos::where('origen','CUENTAS POR COBRAR')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

          $metodos = DB::table('metodos as a')
        ->select('a.id','a.id_paciente','a.id_usuario','a.monto','a.proximo','a.created_at','a.id_producto','c.name','c.lastname','b.nombres','b.apellidos','b.dni','d.nombre as producto')
        ->join('users as c','c.id','a.id_usuario')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('productos as d','d.id','a.id_producto')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
        ->orderBy('a.created_at','desc')
        ->get(); 


        $totalmetodos = Creditos::where('origen','METODOS ANTICONCEPTIVOS')
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('Y-m-d 23:59:59', strtotime($request->fecha))])
                                    ->where('id_sede','=', $request->session()->get('sede'))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();


    
    
     
        $hoy=date('d-m-Y');

                $fechaconsulta=$request->fecha;

       
        $view = \View::make('reportes.detallado', compact('servicios', 'totalServicios','laboratorios', 'totalLaboratorios', 'consultas', 'totalconsultas','otrosingresos','totalotrosingresos','cuentasporcobrar','totalcuentasporcobrar','paquetes','totalPaquetes','metodos','totalmetodos','hoy','fechaconsulta'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('detallado'.$request->fecha.'.pdf');

    }

    private function elasticSearch($id){
        
        $resultados = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.es_delete','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.informe','a.abono','a.resultado','b.nombres as nombrePaciente','b.apellidos as apellidoPaciente','c.detalle as servicio','e.name','e.dni as dniprof','e.lastname','d.name as laboratorio','b.dni')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->whereNotIn('a.monto',[0,0.00])
            ->where('a.es_delete','=',NULL)
        ->where('a.resultado','=', NULL)
        ->where('a.id','=',$id)
        ->first();

        return $resultados;
    }

     private function elasticSearch1($id){
        
        $resultados = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.es_delete','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.informe','a.abono','a.resultado','b.nombres as nombrePaciente','b.apellidos as apellidoPaciente','c.detalle as servicio','e.name','e.dni as ident','e.lastname','d.name as laboratorio','b.dni','f.dni as profdni')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->join('profesionales as f','e.ident','f.dni')
        ->whereNotIn('a.monto',[0,0.00])
            ->where('a.es_delete','=',NULL)
        ->where('a.resultado','=', NULL)
        ->where('a.id','=',$id)
        ->first();

        return $resultados;
    }

    public function materialesusados(Request $request){

        if(!is_null($request->fecha) && !is_null($request->producto)){

        $materiales = DB::table('resultados_materiales as a')
        ->select('a.id','a.id_resultado','a.id_atencion','a.usuario','a.id_material','a.created_at','a.cantidad','b.nombre as producto','at.id_servicio','at.id_paciente','u.name','u.lastname','s.detalle as servicio','p.nombres','p.apellidos')
        ->join('productos as b','b.id','a.id_material')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('users as u','u.id','a.usuario')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->where('a.id_material','=',$request->producto)
        ->get();

        $totalmat = ResultadosMateriales::whereBetween('created_at', [date('Y-m-d 00:00:00',                         strtotime($request->fecha)), date('Y-m-d 23:59:59',strtotime                         ($request->fecha2))])
                                     ->where('id_material','=',$request->producto)
                                    ->select(DB::raw('SUM(cantidad) as cantidad'))
                                    ->first();
        $f1=$request->fecha;
        $f2=$request->fecha2;

          $m = DB::table('resultados_materiales as a')
        ->select('a.id','a.sede','a.id_material','a.created_at','p.nombre',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as p','p.id','a.id_material')
                ->where('a.sede','=',$request->session()->get('sede'))
        ->where('a.id_material','=',$request->producto)
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->groupBy('a.id_material')
        ->get();

        


        }elseif(!is_null($request->fecha) && is_null($request->producto)){

       $materiales = DB::table('resultados_materiales as a')
        ->select('a.id','a.id_resultado','a.id_atencion','a.usuario','a.id_material','a.created_at','a.cantidad','b.nombre as producto','at.id_servicio','at.id_paciente','u.name','u.lastname','s.detalle as servicio','p.nombres','p.apellidos')
        ->join('productos as b','b.id','a.id_material')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('users as u','u.id','a.usuario')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->get();

        $totalmat = ResultadosMateriales::whereBetween('created_at', [date('Y-m-d 00:00:00',                         strtotime($request->fecha)), date('Y-m-d 23:59:59',strtotime                         ($request->fecha2))])
                                    ->select(DB::raw('SUM(cantidad) as cantidad'))
                                    ->first();
        $f1=$request->fecha;
        $f2=$request->fecha2;

         $m = DB::table('resultados_materiales as a')
        ->select('a.id','a.sede','a.id_material','a.created_at','p.nombre',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as p','p.id','a.id_material')
                ->where('a.sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->groupBy('a.id_material')
        ->get();



        }elseif(is_null($request->fecha) && !is_null($request->producto)){

         $materiales = DB::table('resultados_materiales as a')
        ->select('a.id','a.id_resultado','a.id_atencion','a.usuario','a.id_material','a.created_at','a.cantidad','b.nombre as producto','at.id_servicio','at.id_paciente','u.name','u.lastname','s.detalle as servicio','p.nombres','p.apellidos')
        ->join('productos as b','b.id','a.id_material')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('users as u','u.id','a.usuario')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->where('a.id_material','=',$request->producto)
        ->get();

        $totalmat = ResultadosMateriales::where('id_material','=',$request->producto)
                                    ->select(DB::raw('SUM(cantidad) as cantidad'))
                                    ->first();
        $f1=Carbon::today()->toDateString();
        $f2=Carbon::today()->toDateString();

          $m = DB::table('resultados_materiales as a')
        ->select('a.id','a.sede','a.id_material','a.created_at','p.nombre',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as p','p.id','a.id_material')
                ->where('a.sede','=',$request->session()->get('sede'))
        ->where('a.id_material','=',$request->producto)
               ->groupBy('a.id_material')
        ->get();


        }else{ 

        $materiales = DB::table('resultados_materiales as a')
        ->select('a.id','a.id_resultado','a.id_atencion','a.usuario','a.id_material','a.created_at','a.cantidad','b.nombre as producto','at.id_servicio','at.id_paciente','u.name','u.lastname','s.detalle as servicio','p.nombres','p.apellidos')
        ->join('productos as b','b.id','a.id_material')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('users as u','u.id','a.usuario')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->where('a.created_at','=',Carbon::today()->toDateString())
        ->get();

        $totalmat = ResultadosMateriales::where('created_at','=',Carbon::today()->toDateString())
                                    ->select(DB::raw('SUM(cantidad) as cantidad'))
                                    ->first();

         $f1=date('Y-m-d');
        $f2=date('Y-m-d');

          $m = DB::table('resultados_materiales as a')
        ->select('a.id','a.sede','a.id_material','a.created_at','p.nombre',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as p','p.id','a.id_material')
                ->where('a.sede','=',$request->session()->get('sede'))
        ->whereNotIn('a.cantidad',[0])
        ->groupBy('a.id_material')
        ->get();


             

        }


        //$productos = Producto::where('almacen','=',2)->where('categoria','=',4)->where("sede_id","=",$request->session()->get('sede'))->get();

         $productos = DB::table('productos as a')
        ->select('a.id','a.nombre','a.categoria','a.sede_id','a.almacen')
        ->join('resultados_materiales as m','m.id_material','a.id')
        ->where('a.sede_id','=',$request->session()->get('sede'))
       // ->where('a.categoria','=',4)
        //->where('a.almacen','=',2)
        ->orderby('a.nombre','asc')
        ->groupBy('a.id')
        ->get();



            return view('reportes.matusados',compact('m','materiales','totalmat','f1','f2','productos'));


    }

    public function materialesmalogrados(Request $request){


        if(!is_null($request->fecha) && is_null($request->producto)){


            $materiales = DB::table('mat_malogrados as a')
        ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.created_at','b.nombre','c.name','c.lastname','a.id_atencion','at.id_servicio','at.id_paciente','c.name','c.lastname','s.detalle as servicio','p.nombres','p.apellidos')
        ->join('productos as b','b.id','a.id_producto')
        ->join('users as c','c.id','a.usuario')
         ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->get();

        $totalmat = MaterialesMalogrados::whereBetween('created_at', [date('Y-m-d 00:00:00',                         strtotime($request->fecha)), date('Y-m-d 23:59:59',strtotime                         ($request->fecha2))])
                                    ->select(DB::raw('SUM(cantidad) as cantidad'))
                                    ->first();
        $f1=$request->fecha;
        $f2=$request->fecha2;


         $malogrados = DB::table('mat_malogrados as a')
        ->select('a.id','a.created_at','a.id_atencion','a.id_producto','b.nombre',DB::raw('SUM(a.cantidad) as total'),'at.id_paciente','at.id_servicio','s.detalle as servicio','p.nombres as nom','p.apellidos as ape')
        ->join('productos as b','b.id','a.id_producto')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->get();

         $m = DB::table('mat_malogrados as a')
        ->select('a.id','a.sede','a.created_at','a.id_atencion','a.id_producto','b.nombre',DB::raw('SUM(a.cantidad) as total'),'at.id_paciente','at.id_servicio','s.detalle as servicio','p.nombres as nom','p.apellidos as ape')
        ->join('productos as b','b.id','a.id_producto')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->groupBy('a.id_producto')
        ->get();

        


       }elseif (!is_null($request->fecha) && !is_null($request->producto)) {


          $materiales = DB::table('mat_malogrados as a')
        ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.created_at','b.nombre','c.name','c.lastname','a.id_atencion','at.id_servicio','at.id_paciente','c.name','c.lastname','s.detalle as servicio','p.nombres','p.apellidos')
        ->join('productos as b','b.id','a.id_producto')
        ->join('users as c','c.id','a.usuario')
         ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->where('a.id_producto','=',$request->producto)
        ->get();

         $malogrados = DB::table('mat_malogrados as a')
        ->select('a.id','a.created_at','a.id_producto','b.nombre',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as b','b.id','a.id_producto')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->where('a.id_producto','=',$request->producto)
        ->get();

        $m = DB::table('mat_malogrados as a')
        ->select('a.id','a.sede','a.created_at','a.id_atencion','a.id_producto','b.nombre',DB::raw('SUM(a.cantidad) as total'),'at.id_paciente','at.id_servicio','s.detalle as servicio','p.nombres as nom','p.apellidos as ape')
        ->join('productos as b','b.id','a.id_producto')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->groupBy('a.id_producto')
        ->get();

        //dd($malogrados);

        $totalmat = MaterialesMalogrados::whereBetween('created_at', [date('Y-m-d 00:00:00',                         strtotime($request->fecha)), date('Y-m-d 23:59:59',strtotime                         ($request->fecha2))])
                                    ->where('id_producto','=',$request->producto)
                                    ->select(DB::raw('SUM(cantidad) as cantidad'))
                                    ->first();
          $f1=$request->fecha;
        $f2=$request->fecha2;



    }elseif (!is_null($request->producto) && is_null($request->fecha)) {

         $materiales = DB::table('mat_malogrados as a')
        ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.created_at','b.nombre','c.name','c.lastname','a.id_atencion','at.id_servicio','at.id_paciente','c.name','c.lastname','s.detalle as servicio','p.nombres','p.apellidos')
        ->join('productos as b','b.id','a.id_producto')
        ->join('users as c','c.id','a.usuario')
         ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->where('a.id_producto','=',$request->producto)
        ->get();

        $totalmat = MaterialesMalogrados::where('id_producto','=',$request->producto)
                                    ->select(DB::raw('SUM(cantidad) as cantidad'))
                                    ->first();
          $f1=Carbon::today()->toDateString();
        $f2=Carbon::today()->toDateString();

         $malogrados = DB::table('mat_malogrados as a')
        ->select('a.id','a.id_producto','b.nombre',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as b','b.id','a.id_producto')
        ->get();

         $m = DB::table('mat_malogrados as a')
        ->select('a.id','a.sede','a.created_at','a.id_atencion','a.id_producto','b.nombre',DB::raw('SUM(a.cantidad) as total'),'at.id_paciente','at.id_servicio','s.detalle as servicio','p.nombres as nom','p.apellidos as ape')
        ->join('productos as b','b.id','a.id_producto')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->where('a.id_producto','=',$request->producto)
        ->groupBy('a.id_producto')
        ->get();

        
        }else{

         $materiales = DB::table('mat_malogrados as a')
        ->select('a.id','a.id_producto','a.cantidad','a.usuario','a.created_at','b.nombre','c.name','c.lastname','a.id_atencion','at.id_servicio','at.id_paciente','c.name','c.lastname','s.detalle as servicio','p.nombres','p.apellidos')
        ->join('productos as b','b.id','a.id_producto')
        ->join('users as c','c.id','a.usuario')
         ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->where('a.id','=',999999999999999999999)
        ->get();

         $totalmat = MaterialesMalogrados::where('id','=',999999999999999999999)
                                    ->select(DB::raw('SUM(cantidad) as cantidad'))
                                    ->first();


          $f1=date('Y-m-d');
        $f2=date('Y-m-d');


        


         $malogrados = DB::table('mat_malogrados as a')
        ->select('a.id','a.id_producto','b.nombre',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as b','b.id','a.id_producto')
        ->get();

         $m = DB::table('mat_malogrados as a')
        ->select('a.id','a.sede','a.created_at','a.id_atencion','a.id_producto','b.nombre',DB::raw('SUM(a.cantidad) as total'),'at.id_paciente','at.id_servicio','s.detalle as servicio','p.nombres as nom','p.apellidos as ape')
        ->join('productos as b','b.id','a.id_producto')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->groupBy('a.id_producto')
        ->get();

     //   dd($m);



        }

       // $productos = Producto::join('mat_malogrados','mat_malogrados.id_producto','=','productos.id')->where('almacen','=',2)->where('categoria','=',4)->where("sede_id","=",$request->session()->get('sede'))->get();


        $productos = DB::table('productos as a')
        ->select('a.id','a.nombre','a.categoria','a.sede_id','a.almacen')
        ->join('mat_malogrados as m','m.id_producto','a.id')
        ->where('a.sede_id','=',$request->session()->get('sede'))
        ->where('a.categoria','=',4)
        ->where('a.almacen','=',2)
        ->groupBy('a.id')
        ->get();




 
       return view('reportes.matlogrados',compact('m','materiales','totalmat','f1','f2','productos','malogrados'));

    }



    public function reportmalogrados(Request $request,$f1,$f2,$id){


          $materiales = DB::table('mat_malogrados as a')
        ->select('a.id','a.sede','a.created_at','a.id_atencion','a.id_producto','b.nombre',DB::raw('SUM(a.cantidad) as total'),'at.id_paciente','at.id_servicio','s.detalle as servicio','p.nombres as nom','p.apellidos as ape','u.name','u.lastname')
        ->join('productos as b','b.id','a.id_producto')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->join('users as u','u.id','a.usuario')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.id_producto','=',$id)
        ->get();




         $view = \View::make('reportes.malogrados', compact('materiales'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('malogrados'.$id.'.pdf');

      

    }

    public function reportusados(Request $request,$f1,$f2,$id){


          $materiales = DB::table('resultados_materiales as a')
        ->select('a.id','a.sede','a.id_atencion','a.id_material','a.cantidad','a.usuario','a.created_at','b.nombre','c.name','c.lastname','at.id_servicio','at.id_paciente','s.detalle as servicio','p.nombres as nom','p.apellidos as ape','u.name','u.lastname')
        ->join('productos as b','b.id','a.id_material')
        ->join('users as c','c.id','a.usuario')
        ->join('atenciones as at','at.id','a.id_atencion')
        ->join('pacientes as p','p.id','at.id_paciente')
        ->join('servicios as s','s.id','at.id_servicio')
        ->join('users as u','u.id','a.usuario')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.id_material','=',$id)
        ->get();




         $view = \View::make('reportes.usados', compact('materiales'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('usados'.$id.'.pdf');

      

    }

    ///
     public function materialesconsultas(Request $request){


        if(!is_null($request->fecha) && is_null($request->producto)){


        $f1=$request->fecha;
        $f2=$request->fecha2;



          $m = DB::table('materiales_consultas as a')
        ->select('a.id','a.sede','a.created_at','a.id_consulta','a.id_producto','b.nombre','at.paciente','p.nombres as nom','p.apellidos as ape',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as b','b.id','a.id_producto')
        ->join('events as at','at.id','a.id_consulta')
        ->join('pacientes as p','p.id','at.paciente')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->groupBy('a.id_producto')
        ->get();

        


       }elseif (!is_null($request->fecha) && !is_null($request->producto)) {


         
       $m = DB::table('materiales_consultas as a')
        ->select('a.id','a.sede','a.created_at','a.id_consulta','a.id_producto','b.nombre','at.paciente','p.nombres as nom','p.apellidos as ape',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as b','b.id','a.id_producto')
        ->join('events as at','at.id','a.id_consulta')
        ->join('pacientes as p','p.id','at.paciente')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->fecha)), date('                 Y-m-d 23:59:59', strtotime($request->fecha2))])
        ->groupBy('a.id_producto')
        ->get();

    
          $f1=$request->fecha;
        $f2=$request->fecha2;



    }elseif (!is_null($request->producto) && is_null($request->fecha)) {

        

          $f1=Carbon::today()->toDateString();
        $f2=Carbon::today()->toDateString();

        
   $m = DB::table('materiales_consultas as a')
        ->select('a.id','a.sede','a.created_at','a.id_consulta','a.id_producto','b.nombre','at.paciente','p.nombres as nom','p.apellidos as ape',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as b','b.id','a.id_producto')
        ->join('events as at','at.id','a.id_consulta')
        ->join('pacientes as p','p.id','at.paciente')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->where('a.sede','=',$request->session()->get('sede'))
        ->where('a.id_producto','=',$request->producto)
        ->groupBy('a.id_producto')
        ->get();

        
        }else{

       

          $f1=date('Y-m-d');
        $f2=date('Y-m-d');


    

          $m = DB::table('materiales_consultas as a')
        ->select('a.id','a.sede','a.created_at','a.id_consulta','a.id_producto','b.nombre','at.paciente','p.nombres as nom','p.apellidos as ape',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as b','b.id','a.id_producto')
        ->join('events as at','at.id','a.id_consulta')
        ->join('pacientes as p','p.id','at.paciente')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->groupBy('a.id_producto')
        ->get();




        }

     


        $productos = DB::table('productos as a')
        ->select('a.id','a.nombre','a.categoria','a.sede_id','a.almacen')
        ->join('materiales_consultas as m','m.id_producto','a.id')
        ->where('a.sede_id','=',$request->session()->get('sede'))
       // ->where('a.categoria','=',4)
        ->where('a.almacen','=',2)
        ->groupBy('a.id')
        ->get();




 
       return view('reportes.matconsultas',compact('m','f1','f2','productos'));

    }

     public function reportconsultas(Request $request,$f1,$f2,$id){


          $materiales = DB::table('materiales_consultas as a')
        ->select('a.id','a.sede','a.usuario','a.created_at','a.id_consulta','a.id_producto','b.nombre','at.paciente','p.nombres as nom','p.apellidos as ape','u.name','u.lastname',DB::raw('SUM(a.cantidad) as total'))
        ->join('productos as b','b.id','a.id_producto')
        ->join('events as at','at.id','a.id_consulta')
        ->join('pacientes as p','p.id','at.paciente')
        ->join('users as u','u.id','a.usuario')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.id_producto','=',$id)
        ->get();




         $view = \View::make('reportes.consultas', compact('materiales'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('consultas'.$id.'.pdf');

      

    }


    ///

}


