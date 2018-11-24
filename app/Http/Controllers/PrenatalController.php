<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes\Paciente;
use App\Prenatal;
use App\Control;
use DB;

class PrenatalController extends Controller
{
    public function index()
    {
    	$data = $atenciones = DB::table('prenatals as a')
    	->select( 'a.id',
    		'a.paciente',
    		'a.created_at',
			'a.gesta',
			'a.aborto',
			'a.vaginales',
			'a.vivos',
			'a.viven',
			'a.semana1',
			'a.semana2',
			'a.cesaria',
			'a.parto',
			'a.num',
			'a.gr',
			'a.gemelar',
			'a.37m',
			'a.fecha_terminacion',
			'a.peso_gestacion',
			'a.ninguno_af',
			'a.alergias_af',
			'a.anomalias_af',
			'a.epilepsia_af',
			'a.diabetes_af',
			'a.enfermedades_af',
			'a.gemelares_af',
			'a.tension_af',
			'a.neoplasia_af',
			'a.pulmon_af',
			'a.otro_af',
			'a.ninguno_ap',
			'a.aborto_ap',
			'a.aborto2_ap',
			'a.alcohol_ap',
			'a.alermedicamentos_ap',
			'a.asmabron_ap',
			'a.pesonacimiento_ap',
			'a.cardiopatia_ap',
			'a.cirugiauterina_ap',
			'a.diabetes_ap',
			'a.congenitas_ap',
			'a.infeccion_ap',
			'a.epilepsia_ap',
			'a.hemorragiapost_ap',
			'a.htarterial_ap',
			'a.coca_ap',
			'a.infertilidad_ap',
			'a.neoplasias_ap',
			'a.drogas_ap',
			'a.partoprolongado_ap',
			'a.eclampsia_ap',
			'a.prematuro_ap',
			'a.placenta_ap',
			'a.tabaco_ap',
			'a.pulmonar_ap',
			'a.sida_ap',
			'a.otro_ap',
			'a.peso_pregestacional',
			'a.talla_pregestacional',
			'a.dosis_previa',
			'a.primera_dosis',
			'a.segunda_dosis',
			'a.sesion_sangre',
			'a.ultima_menstruacion',
			'a.parto_probable',
			'a.eco_eg',
			 'a.serologia_1era',
			 'a.serologia_2da',
			 'a.hemoglobina',
			 'a.hemoglobina_fecha',
			 'a.patologia_1',
			 'a.patologia_1_date',
			 'a.patologia_1_otro',
			 'a.patologia_2',
			 'a.patologia_2_date',
			 'a.patologia_2_otro',
			 'a.patologia_3',
			 'a.patologia_3_date',
			 'a.patologia_3_otro',
			 'a.talla_nacido',
			 'a.peso_nacido',
			 'a.cef_nacido',
			 'a.temp_nacido',
			 'a.no_rn',
			 'a.nombre_rn',
			 'a.edad_semanas',
			 'a.apgar_1',
			 'a.apgar_2',
			 'a.patologia_recien_1',
			 'a.patologia_recien_1_date',
			 'a.patologia_recien_2',
			 'a.patologia_recien_2_date',
			 'a.patologia_recien_3',
			 'a.patologia_recien_3_date',
			 'a.otros_cie1_10',
			 'a.otros_cie2_10',
			 'p.nombres',
			 'p.apellidos',
			 'p.id as idPaciente')
    	->join('pacientes as p','p.id','a.paciente')
    	->paginate(20);
    	
    	return view('prenatal.index',[
    		 'data' => $data
    	]);     	
    }

    public function createView()
    {
    	$paciente = Paciente::all();

    	return view('prenatal.create',[
    		 'pacientes' => $paciente
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
    public function FichaView($id)
    {
        return Prenatal::where('paciente',$id)->first();
    }

    public function create(Request $request)
    {
    	$prenatal = Prenatal::where('paciente',$request->paciente);
    	if (!$prenatal) {
    		Prenatal::create([
		    	'paciente' =>$request->paciente,
				'gesta' =>$request->gesta,
				'aborto' =>$request->aborto,
				'vaginales' =>$request->vaginales,
				'vivos' =>$request->vivos,
				'viven' =>$request->viven,
				'semana1' =>$request->semana1,
				'semana2' =>$request->semana2,
				'cesaria' =>$request->cesaria,
				'parto' =>$request->parto,
				'num' =>$request->num,
				'gr' =>$request->gr,
				'gemelar' =>$request->gemelar,
				'37m' =>$request->m37m,
				'fecha_terminacion' =>$request->fecha_terminacion,
				'peso_gestacion' =>$request->peso_gestacion,
				'ninguno_af' =>$request->ninguno_af,
				'alergias_af' =>$request->alergias_af,
				'anomalias_af' =>$request->anomalias_af,
				'epilepsia_af' =>$request->epilepsia_af,
				'diabetes_af' =>$request->diabetes_af,
				'enfermedades_af' =>$request->enfermedades_af,
				'gemelares_af' =>$request->gemelares_af,
				'tension_af' =>$request->tension_af,
				'neoplasia_af' =>$request->neoplasia_af,
				'pulmon_af' =>$request->pulmon_af,
				'otro_af' =>$request->otro_af,
				'ninguno_ap' =>$request->ninguno_ap,
				'aborto_ap' =>$request->aborto_ap,
				'aborto2_ap' =>$request->aborto2_ap,
				'alcohol_ap' =>$request->alcohol_ap,
				'alermedicamentos_ap' =>$request->alermedicamentos_ap,
				'asmabron_ap' =>$request->asmabron_ap,
				'pesonacimiento_ap' =>$request->pesonacimiento_ap,
				'cardiopatia_ap' =>$request->cardiopatia_ap,
				'cirugiauterina_ap' =>$request->cirugiauterina_ap,
				'diabetes_ap' =>$request->diabetes_ap,
				'congenitas_ap' =>$request->congenitas_ap,
				'infeccion_ap' =>$request->infeccion_ap,
				'epilepsia_ap' =>$request->epilepsia_ap,
				'hemorragiapost_ap' =>$request->hemorragiapost_ap,
				'htarterial_ap' =>$request->htarterial_ap,
				'coca_ap' =>$request->coca_ap,
				'infertilidad_ap' =>$request->infertilidad_ap,
				'neoplasias_ap' =>$request->neoplasias_ap,
				'drogas_ap' =>$request->drogas_ap,
				'partoprolongado_ap' =>$request->partoprolongado_ap,
				'eclampsia_ap' =>$request->eclampsia_ap,
				'prematuro_ap' =>$request->prematuro_ap,
				'placenta_ap' =>$request->placenta_ap,
				'tabaco_ap' =>$request->tabaco_ap,
				'pulmonar_ap' =>$request->pulmonar_ap,
				'sida_ap' =>$request->sida_ap,
				'otro_ap' =>$request->otro_ap,
				'peso_pregestacional' =>$request->peso_pregestacional,
				'talla_pregestacional' =>$request->talla_pregestacional,
				'dosis_previa' =>$request->dosis_previa,
				'primera_dosis' =>$request->primera_dosis,
				'segunda_dosis' =>$request->segunda_dosis,
				'sesion_sangre' =>$request->sesion_sangre,
				'ultima_menstruacion' =>$request->ultima_menstruacion,
				'parto_probable' =>$request->parto_probable,
				'eco_eg' =>$request->eco_eg,
				'serologia_1era' => $request->serologia_1era,
				'serologia_2da' => $request->serologia_2da,
				'hemoglobina' => $request->hemoglobina,
				'hemoglobina_fecha' => $request->hemoglobina_fecha,
				'patologia_1' => $request->patologia_1,
				'patologia_1_date' => $request->patologia_1_date,
				'patologia_1_otro' => $request->patologia_1_otro,
				'patologia_2' => $request->patologia_2,
				'patologia_2_date' => $request->patologia_2_date,
				'patologia_2_otro' => $request->patologia_2_otro,
				'patologia_3' => $request->patologia_3,
				'patologia_3_date' => $request->patologia_3_date,
				'patologia_3_otro' => $request->patologia_3_otro,
				'talla_nacido' => $request->talla_nacido,
				'peso_nacido' => $request->peso_nacido,
				'cef_nacido' => $request->cef_nacido,
				'temp_nacido' => $request->temp_nacido,
				'no_rn' => $request->no_rn,
				'nombre_rn' => $request->nombre_rn,
				'edad_semanas' => $request->edad_semanas,
				'apgar_1' => $request->apgar_1,
				'apgar_2' => $request->apgar_2,
				'patologia_recien_1' => $request->patologia_recien_1,
				'patologia_recien_1_date' => $request->patologia_recien_1_date,
				'patologia_recien_2' => $request->patologia_recien_2,
				'patologia_recien_2_date' => $request->patologia_recien_2_date,
				'patologia_recien_3' => $request->patologia_recien_3,
				'patologia_recien_3_date' => $request->patologia_recien_3_date,
				'otros_cie1_10' => $request->otros_cie1_10,
				'otros_cie2_10' => $request->otros_cie2_10,
			]);
    	}
		return back();
    }

    public function verControl($id)
    {
    	$control = Control::where('id_paciente',$id)->get();

    	return $control;
    }

    public function createControl(Request $request)
    {
    	Control::create([
    		"id_paciente" => $request->id_paciente,
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
			"responsable_control" => $request->responsable_control,
    	]);

    	return back();
    }
}
