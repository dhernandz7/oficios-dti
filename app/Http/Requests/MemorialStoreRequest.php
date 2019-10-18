<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemorialStoreRequest extends FormRequest
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
            'fecha_evaluacion_audiencia' => 'required|date',
            'numero_proceso' => 'required|string',
            'pdf' => 'required|mimes:pdf|max:10000',
            'tipo_proceso_id' => 'required|integer',
            'plazo_audiencia_id' => 'required|integer',
            'user_id' => 'required|integer'
        ];
    }

    public function attributes()
    {
        return [
            'fecha_notificacion' => 'fecha de notificación',
            'fecha_evaluacion_audiencia' => 'fecha de evaluación audiencia',
            'numero_proceso' => 'número de proceso',
            'pdf' => 'archivo',
            'tipo_proceso_id' => 'tipo de proceso',
            'plazo_audiencia_id' => 'plazo de audiencia',
            'user_id' => 'id del usuario que está registrando el memorial'
        ];
    }

    public function messages()
    {
        return [
            'fecha_notificacion.required' => 'La :attribute es requerida',
            'fecha_notificacion.date' => 'La :attribute debe ser una fecha',
            'fecha_evaluacion_audiencia.required' => 'La :attribute es requerida',
            'fecha_evaluacion_audiencia.date' => 'La :attribute debe ser una fecha',
            'numero_proceso.required' => 'El :attribute es requerido',
            'pdf.required' => 'El :attribute es requerido',
            'pdf.mimes:pdf' => 'El :attribute debe ser de tipo pdf',
            'pdf.max:10000' => 'El :attribute debe pesar como máximo 10MB',
            'tipo_proceso_id.required'=> 'El :attribute es requerido',
            'tipo_proceso_id.integer'=> 'El :attribute debe ser un entero',
            'plazo_audiencia_id.required'=> 'El :attribute es requerido',
            'plazo_audiencia_id.integer'=> 'El :attribute debe ser un entero',
            'user_id.required'=> 'El :attribute es requerido',
            'user_id.integer'=> 'El :attribute debe ser un entero'
        ];
    }
}
