<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProcesoContenciosoAdministrativo;
use App\Http\Requests\CreateProcesoContenciosoAdministrativoRequest;
use App\Http\Requests\UpdateProcesoContenciosoAdministrativoRequest;

class ProcesoContenciosoAdministrativoController extends Controller
{
    public function index()
    {
    	$procesos = ProcesoContenciosoAdministrativo::
        join('proveniencias', 'procesos_contenciosos_administrativos.proveniente_id', 'proveniencias.id')
        ->join('objeto_litis', 'procesos_contenciosos_administrativos.objeto_litis_id', 'objeto_litis.id')
        ->join('tipo_evacuacion', 'procesos_contenciosos_administrativos.tipo_evacuacion_id', 'tipo_evacuacion.id')
        ->join('estado_proceso', 'procesos_contenciosos_administrativos.estado_proceso_id', 'estado_proceso.id')
        ->select([
            'procesos_contenciosos_administrativos.id',
            'procesos_contenciosos_administrativos.numero_de_proceso',
            'procesos_contenciosos_administrativos.proveniente_id',
            'proveniencias.proveniencia',
            'procesos_contenciosos_administrativos.fecha_de_notificacion',
            'procesos_contenciosos_administrativos.objeto_litis_id',
            'objeto_litis.objeto_litis',
            'procesos_contenciosos_administrativos.nombre_de_entidad_demandante',
            'procesos_contenciosos_administrativos.nombre_de_demandado',
            'procesos_contenciosos_administrativos.tipo_evacuacion_id',
            'tipo_evacuacion.tipo_evacuacion',
            'procesos_contenciosos_administrativos.estado_proceso_id',
            'estado_proceso.estado_proceso',
            'procesos_contenciosos_administrativos.anotacion'
        ])
        ->get();

        return response()->json(['data' => $procesos], 200);
    }

    public function store(CreateProcesoContenciosoAdministrativoRequest $request)
    {
        $proceso = ProcesoContenciosoAdministrativo::create([
            'numero_de_proceso' => $request->numero_de_proceso,
            'proveniente_id' => $request->proveniencia["proveniente_id"],
            'fecha_de_notificacion' => $request->fecha_de_notificacion,
            'objeto_litis_id' => $request->objeto_litis["objeto_litis_id"],
            'nombre_de_entidad_demandante' => $request->nombre_de_entidad_demandante,
            'nombre_de_demandado' => $request->nombre_de_demandado,
            'tipo_evacuacion_id' => $request->tipo_evacuacion["tipo_evacuacion_id"],
            'estado_proceso_id' => $request->estado_proceso["estado_proceso_id"],
            'anotacion' => $request->anotacion
        ]);

        return response()->json([
            'id' => $proceso->id,
            'numero_de_proceso' => $request->numero_de_proceso,
            'proveniente_id' => $request->proveniencia["proveniente_id"],
            'proveniencia' => $request->proveniencia["proveniencia"],
            'fecha_de_notificacion' => $request->fecha_de_notificacion,
            'objeto_litis_id' => $request->objeto_litis["objeto_litis_id"],
            'objeto_litis' => $request->objeto_litis["objeto_litis"],
            'nombre_de_entidad_demandante' => $request->nombre_de_entidad_demandante,
            'nombre_de_demandado' => $request->nombre_de_demandado,
            'tipo_evacuacion_id' => $request->tipo_evacuacion["tipo_evacuacion_id"],
            'tipo_evacuacion' => $request->tipo_evacuacion["tipo_evacuacion"],
            'estado_proceso_id' => $request->estado_proceso["estado_proceso_id"],
            'estado_proceso' => $request->estado_proceso["estado_proceso"],
            'anotacion' => $request->anotacion
        ], 200);
    }

    public function update(UpdateProcesoContenciosoAdministrativoRequest $request, $id)
    {
        ProcesoContenciosoAdministrativo::find($id)->update([
            'estado_proceso_id' => $request->estado_proceso_id
        ]);

        return response()->json($request->estado_proceso_id, 200);
    }
}
