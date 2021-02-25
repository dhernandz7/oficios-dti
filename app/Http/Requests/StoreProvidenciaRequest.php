<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProvidenciaRequest extends FormRequest
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
            'tipo_documento_id' => 'required|integer',
            'user_id' => 'required|integer'
        ];
    }

    public function attributes()
    {
        return [
            'tipo_documento_id' => 'tipo de documento',
            'user_id' => 'id del usuario que está reservando el memorándum'
        ];
    }

    public function messages()
    {
        return [
            'tipo_documento_id.required' => 'El :attribute es requerido',
            'tipo_documento_id.required' => 'El :attribute debe ser un entero',
            'user_id.required' => 'El :attribute es requerido',
            'user_id.required' => 'El :attribute debe ser un entero'
        ];
    }
}
