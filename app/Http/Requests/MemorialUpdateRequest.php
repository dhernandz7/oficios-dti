<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemorialUpdateRequest extends FormRequest
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
            'fecha_notificacion' => 'required|date',
            'fecha_evacuacion_audiencia' => 'required|date',
            'numero_proceso' => 'required|string',
            'pdf' => 'nullable|mimes:pdf|max:10000',
            'tipo_proceso_id' => 'required|integer',
            'plazo_audiencia_id' => 'required|integer'
        ];
    }

    public function attributes()
    {
        return [
            'fecha_notificacion' => 'fecha de notificación',
            'fecha_evacuacion_audiencia' => 'fecha de evacuación audiencia',
            'numero_proceso' => 'número de proceso',
            'pdf' => 'archivo',
            'tipo_proceso_id' => 'tipo de proceso',
            'plazo_audiencia_id' => 'plazo de audiencia'
        ];
    }

    public function messages()
    {
        return [
            'fecha_notificacion.date' => 'La :attribute debe ser una fecha',
            'fecha_evacuacion_audiencia.date' => 'La :attribute debe ser una fecha',
            'pdf.mimes:pdf' => 'El :attribute debe ser de tipo pdf',
            'pdf.max:10000' => 'El :attribute debe pesar como máximo 10MB',
            'tipo_proceso_id.integer'=> 'El :attribute debe ser un entero',
            'plazo_audiencia_id.integer'=> 'El :attribute debe ser un entero'
        ];
    }
}
