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

	public function index(){
        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $visitas = $this->elasticSearch($inicio,$final);
        $profesionales = Profesional::where("estatus", '=', 1)->get();

        return view('visitas.index', ["visitas" => $visitas,"profesionales" => $profesionales]);
	}

    public function search(Request $request)
    {
        $visitas = $this->elasticSearch($request->inicio,$request->final);
        return view('visitas.search', ["visitas" => $visitas]); 
    }


  private function elasticSearch($initial, $final)
  { 
        $visitas = DB::table('visitas as a')
        ->select('a.id','a.id_profesional','a.id_visitador','a.created_at','b.name','b.apellidos','c.name as nomvi','c.lastname as apevi','b.centro','b.especialidad','d.name as centro','e.nombre as especialidad')/*,'c.name as nomvi','c.lastname as apevi','a.created_at'*/
        ->join('profesionales as b','b.id','a.id_profesional')
        ->join('users as c','c.id','a.id_visitador')
        ->join('centros as d','b.centro','d.id')
        ->join('especialidades as e','e.id','b.especialidad')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
        ->orderby('a.id','desc')
        ->get();


        return $visitas;
  }



  public function createView() {

    $profesionales =Profesional::where("estatus", '=', 1)->get();
    
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
}
