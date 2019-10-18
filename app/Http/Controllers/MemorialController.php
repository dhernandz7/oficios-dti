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
            'tipo_proceso.tipo_proceso',
            'plazo_audiencia.plazo_audiencia',
            'users.name',
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
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'id' => $memorial->id,
            'fecha_notificacion' => $memorial->fecha_notificacion,
            'fecha_evaluacion_audiencia' => $memorial->fecha_evaluacion_audiencia,
            'numero_proceso' => $memorial->numero_proceso,
            'path' => $memorial->path,
            'tipo_proceso' => $request->tipo_proceso,
            'plazo_audiencia' => $request->plazo_audiencia,
            'name' => $request->name,
            'created_at' => $memorial->created_at,
            'bloqueado' => $memorial->bloqueado
        ] ,200);
    }

    public function update(MemorialUpdateRequest $request, $id)
    {
    	Memorial::find($id)->update($request->all());
        return response()->json([] ,200);
    }
}
