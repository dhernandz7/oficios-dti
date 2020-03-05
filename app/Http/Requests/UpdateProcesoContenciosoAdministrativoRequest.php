<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProcesoContenciosoAdministrativoRequest extends FormRequest
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
            //'fecha' => 'required|date',
            //'numero_de_proceso' => 'required|string|unique:procesos_contenciosos_administrativos',
            //'proveniente' => 'required|array',
            //'fecha_de_notificacion' => 'required|date',
            //'objeto_litis' => 'required|array',
            //'nombre_de_entidad_demandante' => 'required|string|max:255',
            //'nombre_de_demandado' => 'required|string|max:255',
            //'tipo_evacuacion' => 'required|array',
            'estado_proceso_id' => 'required|integer',
            //'anotacion' => 'nullable|string|max:255'
        ];
    }

    public function attributes()
    {
        return [
            //'fecha' => 'fecha de proceso',
            //'numero_de_proceso' => 'número de proceso',
            //'proveniente' => 'proveniente de',
            //'fecha_de_notificacion' => 'fecha de notificación',
            //'objeto_litis' => 'objeto de litis',
            //'nombre_de_entidad_demandante' => 'nombre de la entidad demandante',
            //'nombre_de_demandado' => 'nombre del demandado',
            //'tipo_evacuacion' => 'tipo de evacuación',
            'estado_proceso_id' => 'estado del proceso',
            //'anotacion' => 'anotación'
        ];
    }
}
