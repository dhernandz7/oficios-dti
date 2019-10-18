<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Memorial;
use App\Http\Requests\MemorialStoreRequest;
use App\Http\Requests\MemorialUpdateRequest;

class MemorialController extends Controller
{
    public function index()
    {
    	$memoriales = Memorial::
        join('tipo_proceso', 'memoriales.tipo_proceso_id', 'tipo_proceso.id')
        ->join('plazo_audiencia', 'memoriales.plazo_audiencia_id', 'plazo_audiencia.id')
        ->join('users', 'memoriales.user_id', 'users.id')
        ->select([
            'memoriales.id',
            'memoriales.fecha_notificacion',
            'memoriales.fecha_evaluacion_audiencia',
            'memoriales.numero_proceso',
            'memoriales.path',
            'memoriales.tipo_proceso_id',
            'tipo_proceso.tipo_proceso',
            'memoriales.plazo_audiencia_id',
            'plazo_audiencia.plazo_audiencia',
            'users.name',
            'memoriales.user_id',
            'memoriales.created_at',
            'memoriales.bloqueado'
        ])
        ->get();

        return response()->json(["data" => $memoriales], 200);
    }

    public function store(MemorialStoreRequest $request)
    {
        $path = null;

        if($request->hasFile('pdf')) {
            $hash_pdf = str_random(7);
            $path = $request->file('pdf')->storeAs("public/memoriales/". substr($request->fecha_notificacion, 0, 4), "$hash_pdf.pdf");
        }

        $memorial = Memorial::create([
            'fecha_notificacion' => $request->fecha_notificacion,
            'fecha_evaluacion_audiencia' => $request->fecha_evaluacion_audiencia,
            'numero_proceso' => $request->numero_proceso,
            'path' => $path,
            'tipo_proceso_id' => $request->tipo_proceso_id,
            'plazo_audiencia_id' => $request->plazo_audiencia_id,
            'user_id' => $request->user_id,
            'bloqueado' => 0
        ]);

        return response()->json([
            'id' => $memorial->id,
            'fecha_notificacion' => $memorial->fecha_notificacion,
            'fecha_evaluacion_audiencia' => $memorial->fecha_evaluacion_audiencia,
            'numero_proceso' => $memorial->numero_proceso,
            'path' => $memorial->path,
            'tipo_proceso_id' => $memorial->tipo_proceso_id,
            'tipo_proceso' => $request->tipo_proceso,
            'plazo_audiencia_id' => $memorial->plazo_audiencia_id,
            'plazo_audiencia' => $request->plazo_audiencia,
            'user_id' => $memorial->user_id,
            'name' => $request->name,
            'created_at' => $memorial->created_at,
            'bloqueado' => $memorial->bloqueado
        ] ,200);
    }

    public function update(MemorialUpdateRequest $request, $id)
    {
        $memorial = Memorial::find($id);
        $path = null;
        $path_anterior = null;

        if($request->hasFile('pdf')) {
            $path_anterior = $memorial->path;
            $hash_pdf = str_random(7);
            $path = $request->file('pdf')->storeAs("public/memoriales/". substr($request->fecha_notificacion, 0, 4), "$hash_pdf.pdf");
            $memorial->path = $path;
        }

        $memorial->fecha_notificacion = $request->fecha_notificacion;
        $memorial->fecha_evaluacion_audiencia = $request->fecha_evaluacion_audiencia;
        $memorial->numero_proceso = $request->numero_proceso;
        $memorial->tipo_proceso_id = $request->tipo_proceso_id;
        $memorial->plazo_audiencia_id = $request->plazo_audiencia_id;
        $memorial->bloqueado = 1;

        if($memorial->save()) {
            \Storage::delete($path_anterior);
            return response()->json([
                'id' => $memorial->id,
                'fecha_notificacion' => $memorial->fecha_notificacion,
                'fecha_evaluacion_audiencia' => $memorial->fecha_evaluacion_audiencia,
                'numero_proceso' => $memorial->numero_proceso,
                'path' => $memorial->path,
                'tipo_proceso_id' => $memorial->tipo_proceso_id,
                'tipo_proceso' => $request->tipo_proceso,
                'plazo_audiencia_id' => $memorial->plazo_audiencia_id,
                'plazo_audiencia' => $request->plazo_audiencia,
                'user_id' => $memorial->user_id,
                'name' => $request->name,
                'created_at' => $memorial->created_at,
                'bloqueado' => $memorial->bloqueado
            ] ,200);
        } else {
            \Storage::delete($path);
            return response()->json("Lo sentimos, no se pudo actualizar el memorial $memorial->numero_proceso, intente más tarde",503);
        }
    }
}
