<?php

namespace App\Http\Controllers;
use App\Historial;
use Illuminate\Http\Request;
use App\Http\Requests\CreateHistorialRequest;

class HistorialController extends Controller
{
    public function create(Request $request){


    	Historial::create([
    		'antecedentes_familiar' => $request->a_familiares,
    		'antecedentes_personales' => $request->a_personales,
    		'antecedentes_patologicos' => $request->a_patologicos,
    		'alergias' => $request->alergias,
            'menarquia' => $request->menarquia,
            'prs' => $request->prs,
    		'paciente_id' => $request->paciente_id,
    		'profesional_id' => $request->profesional_id,
    	]);	
    	return back();
    }
}
