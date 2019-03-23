<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Profesionales\Profesional;
use App\Models\Debitos;
use App\Models\Visitas;
use App\Models\Analisis;
use Auth;
use Toastr;

class VisitasController extends Controller

{

	public function index(Request $request){

    if(!is_null($request->fecha)){

      $f1=$request->fecha;
      $f2=$request->fecha2;


    $visitas = DB::table('visitas as a')
        ->select('a.id','a.id_profesional','a.id_visitador','a.created_at','b.name','b.apellidos','c.name as nomvi','c.lastname as apevi','b.centro','b.especialidad','d.name as centro','e.nombre as especialidad')/*,'c.name as nomvi','c.lastname as apevi','a.created_at'*/
        ->join('profesionales as b','b.id','a.id_profesional')
        ->join('users as c','c.id','a.id_visitador')
        ->join('centros as d','b.centro','d.id')
        ->join('especialidades as e','e.id','b.especialidad')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderby('a.id','desc')
        ->get();

            $total= Visitas::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->select(DB::raw('COUNT(*) as total'))
            ->first();

      } else {

          $visitas = DB::table('visitas as a')
        ->select('a.id','a.id_profesional','a.id_visitador','a.created_at','b.name','b.apellidos','c.name as nomvi','c.lastname as apevi','b.centro','b.especialidad','d.name as centro','e.nombre as especialidad')/*,'c.name as nomvi','c.lastname as apevi','a.created_at'*/
        ->join('profesionales as b','b.id','a.id_profesional')
        ->join('users as c','c.id','a.id_visitador')
        ->join('centros as d','b.centro','d.id')
        ->join('especialidades as e','e.id','b.especialidad')
        ->whereDate('a.created_at',Carbon::today()->toDateString())
        ->orderby('a.id','desc')
        ->get();

        $total= Visitas::whereDate('created_at',Carbon::today()->toDateString())
        ->select(DB::raw('COUNT(*) as total'))
        ->first();


      $f1=Carbon::today()->toDateString();
      $f2=Carbon::today()->toDateString();




      }

        

        return view('visitas.index', ["visitas" => $visitas,"f1" => $f1, "f2" => $f2,"total" => $total]);
	}

    public function search(Request $request)
    {
        $visitas = $this->elasticSearch($request->inicio,$request->final);
        return view('visitas.search', ["visitas" => $visitas]); 
    }


  public function createView() {

    $profesionales =Profesional::where("estatus", '=', 1)->orderby('apellidos','asc')->get();
    
    return view('visitas.create', compact('profesionales'));
  }

  public function create(Request $request){

		$visitas = Visitas::create([
	      'id_profesional' => $request->profesional,
	      'id_visitador' => Auth::id()
	    
   		]);

		Toastr::success('La Visita Fue Registrada.', 'Profesional Visitadp!', ['progressBar' => true]);
       return redirect()->route('visitas.index');
	} 


    public function reporte_visitas(Request $request){

    $visitas = DB::table('visitas as a')
        ->select('a.id','a.id_profesional','a.id_visitador','a.created_at','b.name','b.apellidos','c.name as nomvi','c.lastname as apevi','b.centro','b.especialidad','d.name as centro','e.nombre as especialidad')/*,'c.name as nomvi','c.lastname as apevi','a.created_at'*/
        ->join('profesionales as b','b.id','a.id_profesional')
        ->join('users as c','c.id','a.id_visitador')
        ->join('centros as d','b.centro','d.id')
        ->join('especialidades as e','e.id','b.especialidad')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($request->f1)), date('Y-m-d 23:59:59', strtotime($request->f2))])
        ->orderby('a.id','desc')
        ->get();

        $f1=$request->f1;
        $f2=$request->f2;


 
        $view = \View::make('visitas.reporte')->with('visitas', $visitas)->with('f1', $f1)->with('f2', $f2);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('total_visitas');

  }





}
