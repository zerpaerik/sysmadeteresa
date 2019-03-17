<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes\Paciente;
use App\Models\Historiales;
use App\Models\Events\{Event, RangoConsulta};
use App\Prenatal;
use App\Control;
use App\User;
use DB;
use Toastr;
use Auth;


class PrenatalController extends Controller
{

	public function index(){
    
        $prenatal = $this->elasticSearch('');
   
        return view('prenatal.index', ["prenatal" => $prenatal]);
	}

    public function search(Request $request)
    {
      $search = $request->dni;
      $split = explode(" ",$search);
    

      if (!isset($split[1])) {
       
        $split[1] = '';
        $prenatal = $this->elasticSearch($split[0],$split[1]);
      
        return view('prenatal.search', ["prenatal" => $prenatal]); 

      }else{
        $prenatal = $this->elasticSearch($split[0],$split[1]); 
      
        return view('prenatal.search', ["prenatal" => $prenatal]);   
      }    
    }

      private function elasticSearch($dni)
  { 
      $prenatal = DB::table('prenatals as a')
    	->select( 'a.id',
    			'a.paciente' ,
				'a.gesta' ,
				'a.aborto' ,
				'a.vaginales' ,
				'a.vivos' ,
				'a.viven' ,
				'a.semana1' ,
				'a.semana2' ,
				'a.cesaria' ,
				'a.parto' ,
				'a.num' ,
				'a.gr' ,
				'a.gemelar' ,
				'a.m37m' ,
				'a.fecha_terminacion' ,
				'a.peso_gestacion' ,
								'a.muertos',

								'a.aborto_gestacion',

				'a.peso_pregestacional' ,
				'a.talla_pregestacional' ,
			
				'a.ultima_menstruacion' ,
				'a.parto_probable' ,
				'a.eco_eg' ,
				
				'a.sangre' ,
				'a.sangrerh' ,
				'a.created_at',
				'a.orina' ,
				'a.orinad',
				'a.urea',
				'a.uread',
				'a.creatinina',
				'a.creatininad',
				'a.bic',
				'a.bicd',
				'a.torch',
				'a.torchd',
				'a.terminacion' ,
				
				'a.af',
				'a.ap',
			 'p.nombres',
			 'p.apellidos',
			 'p.dni',
			 'p.id as idPaciente')
    	->join('pacientes as p','p.id','a.paciente')
        ->where('p.dni','like','%'.$dni.'%')
        ->groupBy('a.paciente')
        ->get();
        return $prenatal;
  }

    public function createView($paciente,$evento)
    {
    	$event= Event::where('id','=',$evento)->first();
    	$control  = Control::where('id_paciente','=',$paciente)->get();
    	$prenatal = Prenatal::where('paciente',$paciente)->first();
    	$paciente = Paciente::where('id','=',$paciente)->first();

    	return view('prenatal.create',[
    		 'paciente' => $paciente,
    		 'prenatal' => $prenatal,
    		 'control' => $control,
    		 'evento' =>$event
    	]); 
    }
	public function createControlView($id)
	{
		$data = Prenatal::where('paciente',$id)->first();
		$paciente = Paciente::where('id',$data->paciente)->first();
		
		return view('prenatal.control-create',[
			'data' => $data,
			'paciente' => $paciente
		]);
	}
    public function show($id)
    {
       // $data = Prenatal::where('paciente', $id)->first();
//        $paciente = Paciente::where('id',$data->id)->first();
        $data = DB::table('prenatals as a')
    	->select( 'a.id',
				'a.paciente' ,
				'a.gesta' ,
				'a.aborto' ,
				'a.vaginales' ,
				'a.vivos' ,
				'a.viven' ,
				'a.semana1' ,
				'a.semana2' ,
				'a.cesaria' ,
				'a.parto' ,
				'a.num' ,
				'a.muertos',
				'a.imc',
				'a.gr' ,
				'a.gemelar' ,
				'a.m37m' ,
				'a.fecha_terminacion' ,
				'a.peso_gestacion' ,
				'a.created_at',
				'a.aborto_gestacion',
				'a.peso_pregestacional' ,
				'a.talla_pregestacional' ,
				'a.ultima_menstruacion' ,
				'a.parto_probable' ,
				'a.eco_eg' ,
				'a.conclusion',
				'a.sangre' ,
				'a.sangrerh' ,
				'a.orina' ,
				'a.orinad',
				'a.urea',
				'a.uread',
				'a.creatinina',
				'a.creatininad',
				'a.bic',
				'a.bicd',
				'a.torch',
				'a.torchd',
				'a.terminacion' ,
				'a.af',
				'a.ap',
			 'p.nombres',
			 'p.apellidos',
			 'p.dni',
			 'p.id as idPaciente')
    	->join('pacientes as p','p.id','a.paciente')
        ->where('p.id','=',$id)
        ->first();

       $control = Control::where('id_paciente','=',$id)->get();

        return view('prenatal.show',[
        	'data' => $data,
        	'control' => $control
        ]);
    }

    public function create(Request $request)
    {

          
    		Prenatal::create([
		    	'paciente' =>$request->paciente,
				'gesta' =>$request->gesta,
				'aborto' =>$request->aborto,
				'vaginales' =>$request->vaginales,
				'vivos' =>$request->vivos,
				'viven' =>$request->viven,
				'muertos'=>$request->muertos,
				'semana1' =>$request->semana1,
				'semana2' =>$request->semana2,
				'cesaria' =>$request->cesaria,
				'parto' =>$request->parto,
				'num' =>$request->num,
				'gr' =>$request->gr,
				'gemelar' =>$request->gemelar,
				'm37m' =>$request->m37m,
				'terminacion_gestacion' =>$request->terminacion_gestacion,
				'fecha_terminacion' =>$request->fecha_terminacion,
				'peso_gestacion' =>$request->peso_gestacion,
				'aborto_gestacion' =>$request->aborto_gestacion,
				'af'=> json_encode($request->af),
				'ap'=> json_encode($request->ap),
				'peso_pregestacional' =>$request->peso_pregestacional,
				'talla_pregestacional' =>$request->talla_pregestacional,
				'conclusion' =>$request->conclusion,
				'sangre' =>$request->sangre,
				'sangrerh' =>$request->sangrerh,
				'ultima_menstruacion' =>$request->ultima_menstruacion,
				'parto_probable' =>$request->parto_probable,
				'eco_eg' =>$request->eco_eg,
				'orina' =>$request->orina,
				'orinad' =>$request->orinad,
				'urea' =>$request->urea,
				'uread' =>$request->uread,
				'creatinina' =>$request->creatinina,
				'creatininad' =>$request->creatininad,
				'bic' =>$request->bic,
				'bicd' =>$request->bicd,
				'torch' =>$request->torch,
				'torchd' =>$request->torchd,
				'imc' => $request->peso_pregestacional / $request->talla_pregestacional * $request->talla_pregestacional


				
			]);

			

			
			
			

		Toastr::success('Registrado Exitosamente.', 'Consulta Prenatal!', ['progressBar' => true]);

       return back();

		
    }

    public function verControl($id)
    {

    	$control = Control::where('id_paciente',$id)->get();
    	$paciente = Paciente::where('id',$id)->get();
    	$prenatal = Prenatal::where('paciente',$id)->get();
    	$view = \View::make('prenatal.reporte')->with('controles', $control)->with('pacientes', $paciente)->with('prenatal', $prenatal);
        $pdf = \App::make('dompdf.wrapper');
     //   $pdf->setPaper(array(0,0,867.00,343.80));
        $pdf->loadHTML($view);
        return $pdf->stream('resultados_ver');
    }

    public function createControl(Request $request)
    {

        $usuario = User::where('id','=', Auth::user()->id)->first();





    	Control::create([
    		"id_paciente" => $request->paciente,
			"id_ficha_prenatal" => $request->id_ficha_prenatal,
			"fecha_cont" => $request->fecha_cont,
			"gesta_semanas" => $request->gesta_semanas,
			"peso_madre" => $request->peso_madre,
			"temp" => $request->temp,
			"tension" => $request->tension,
			"altura_uterina" => $request->altura_uterina,
			"presentacion" => $request->presentacion,
			"fcf" => $request->fcf,
			"movimiento_fetal" => $request->movimiento_fetal,
			"edema" => $request->edema,
			"pulso_materno" => $request->pulso_materno,
			"consejeria" => $request->consejeria,
			"sulfato" => $request->sulfato,
			"perfil_biofisico" => $request->perfil_biofisico,
			"visita_domicilio" => $request->visita_domicilio,
			"establecimiento_atencion" => $request->establecimiento_atencion,
			"responsable_control" => $usuario->name.' '.$usuario->lastname,
			"sero" => $request->sero,
			"serod" => $request->serod,
			"glu" => $request->gluco,
			"glud" => $request->glucod,
			"vih" => $request->vih,
			"vihd" => $request->vihd,
			"hemo" => $request->hemo,
			"hemod" => $request->hemod,
			//"fc" => $request->fc,
			"fr" => $request->fr,
			"pri" => $request->pri,
			"peso" => $request->peso,
			"talla" => $request->talla,
			"pp" => $request->pp,
			"piel" => $request->piel,
			"mamas" => $request->mamas,
			"abdomen" => $request->abdomen,
			"genext" => $request->genext,
			"genint" => $request->genint,
			"miembros" => $request->miembros,
			"pres" => $request->pres,
			"exa" => $request->exa,
			"def" => $request->def,
			"tra" => $request->tra,

    	]);

    	 $event = Event::find($request->evento);
		    $event->atendido=1;
		    $event->update();

    	Toastr::success('Registrado Exitosamente.', 'Control Prenatal!', ['progressBar' => true]);

		return back();

    }
}
