<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsignarPdfDictamenRequest extends FormRequest
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
            'pdf' => 'required|mimes:pdf|max:3000'
        ];
    }

    public function attributes()
    {
        return [
            'pdf' => 'archivo'
        ];
    }

    public function messages()
    {
        return [
            'pdf.required' => 'El :attribute es requerido',
            'pdf.mimes:pdf' => 'El :attribute debe ser un pdf',
            'pdf.max:3000' => 'El :attribute debe pesar como máximo 3MB',
        ];
    }
}
