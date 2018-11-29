<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consulta;
use App\Http\Requests\CreateConsultaRequest;
class ConsultaController extends Controller
{
    public function create(Request $request)
    {
    	Consulta::create([
    		'pa' => $request->pa,
    		'pulso' => $request->pulso,
    		'temperatura' => $request->temperatura,
    		'peso' => $request->peso,
    		'fur' => $request->fur,
    		'motivo_consulta' => $request->motivo_consulta,
    		'tipo_enfermedad' => $request->tipo_enfermedad,
    		'evolucion_enfermedad' => $request->evolucion_enfermedad,
    		'examen_fisico_regional' => $request->examen_fisico,
    		'presuncion_diagnostica' => $request->presuncion_diagnostica,
    		'diagnostico_final' => $request->diagnostico_final,
    		'CIEX' => $request->ciex1,
    		'CIEX2' => $request->ciex2,
    		'examen_auxiliar' => $request->examen_auxiiar,
    		'plan_tratamiento' => $request->plan_tratamiento,
    		'obervaciones' => $request->observaciones,
    		'paciente_id' => $request->paciente_id,
    		'profesional_id' => $request->profesional_id,
            'prox' => $request->prox,
            'personal' => $request->personal,
            'apetito' => $request->apetito,
            'sed' => $request->sed,
            'card' => $request->card,
            'animo' => $request->animo,
            'deposiciones' => $request->deposiciones,
            'orina' => $request->orina


    	]);

    	return back();

    }
}
