<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class actaDefuncionPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'acta' => 'required',
            'libro' => 'required',
            'fecha_registro' => 'required|date',
            'dni' => 'nullable|max:8',
            'nombres' => 'nullable',
            'apellido_paterno' => 'nullable',
            'apellido_materno' => 'nullable',
            'sexo' => 'required',
            'fecha_defuncion' => 'required|date',
            'archivo' => 'required',
        ];
    }
}
