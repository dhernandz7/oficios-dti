<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsignarMemorandumRequest extends FormRequest
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
            'oficio_id' => 'required',
            'oficio_anio' => 'required',
            'tipo_documento_id' => 'required',
            'user_id' => 'required',
            'name' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'oficio_id' => 'memorándum id',
            'oficio_anio' => 'memorándum año',
            'tipo_documento_id' => 'tipo de documento',
            'user_id' => 'id del usuario que está reservando',
            'name' => 'nombre del usuario que está reservando'
        ];
    }

    public function messages()
    {
        return [
            'oficio_id.required' => 'El :attribute es requerido',
            'oficio_anio.required' => 'El :attribute es requerido',
            'tipo_documento_id.required' => 'El :attribute es requerido',
            'user_id.required' => 'El :attribute es requerido',
            'name.required' => 'El :attribute es requerido',
            'name.string' => 'El :attribute debe ser una cadena',
        ];
    }
}
