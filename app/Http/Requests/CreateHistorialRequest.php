<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHistorialRequest extends FormRequest
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
            'antecedentes_familiar' =>'required',
            'antecedentes_personales' =>'required',
            'antecedentes_patologicos' =>'required',
            'alergias' =>'required',
        ];
    }
}
