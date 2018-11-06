<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateConsultaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'pa' => 'required|string',
            'pulso' => 'required|string',
            'temperatura' => 'required|string',
            'peso' => 'required|string',
            'g' => 'required|string',
            'p' => 'required|string',
            'menarquia' => 'required|string',
            '1_r_s' => 'required|string',
            'fur' => 'required|string',
            'rc' => 'required|string',
            'MAC' => 'required|string',
            'fecha_ultimo_pap' => 'required|date:',
            'motivo_consulta' => 'required|string',
            'tipo_enfermedad' => 'required|string',
            'evolucion_enfermedad' => 'required|string',
            'funciones_biologicas' => 'required|string',
            'examen_fisico_regional' => 'required|string',
            'presuncion_diagnostica' => 'required|string',
            'diagnostico_final' => 'required|string',
            'CIEX' => 'required|string',
            'CIEX2' => 'required|string',
            'examen_auxiliar' => 'required|string',
            'plan_tratamiento' => 'required|string',
            'obervaciones' => 'required|string',
            'paciente_id' => 'required|string',
            'profesional_id' => 'required|string',
        ];
    }
}
