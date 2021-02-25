<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProvidenciaRequest;
use App\Http\Requests\AsignarProvidenciaRequest;
use App\Http\Requests\AsignarPdfProvidenciaRequest;
use App\Providencia;
use App\Asignacion;
use DB;

class ProvidenciaController extends Controller
{
    public function index()
    {
        $providencias = Providencia::
        leftJoin('asignaciones', function($join) {
            $join->on('providencias.id', '=', 'asignaciones.oficio_id');
            $join->on('providencias.anio', '=', 'asignaciones.oficio_anio')
            ->where('asignaciones.tipo_documento_id', '=', 4);
        })
        ->leftJoin('users', 'asignaciones.user_id','users.id')
        //->where('providencias.anio', 2019)
        ->select([
            'asignaciones.id as asignacion_id',
            'providencias.id as oficio_id',
            'providencias.anio as oficio_anio',
            'asignaciones.created_at',
            'users.name',
            'asignaciones.path',
            'asignaciones.tipo_documento_id'
        ])
        ->orderBy('providencias.id')
        ->get();

        return response()->json(["data" => $providencias], 200);
    }

    public function reservarAutomaticamente(StoreProvidenciaRequest $request)
    {
        $memorandum = Providencia::create([
            'anio' => date('Y')
        ]);

        $asignacion = Asignacion::create([
            'oficio_id' => $memorandum->id,
            'oficio_anio' => $memorandum->anio,
            'path' => null,
            'tipo_documento_id' => $request->tipo_documento_id,
            'user_id' => $request->user_id
        ]);
        return response()->json([
            'asignacion_id' => $asignacion->id,
            'oficio_id' => $asignacion->oficio_id,
            'oficio_anio' => $asignacion->oficio_anio,
            'created_at' => $asignacion->created_at,
            'name' => $request->name,
            'path' => $asignacion->path,
            'tipo_documento_id' => $asignacion->tipo_documento_id
        ],200);
    }

    public function reservar(AsignarProvidenciaRequest $request)
    {
        $asignacion = Asignacion::create([
            'oficio_id' => $request->oficio_id,
            'oficio_anio' => $request->oficio_anio,
            'path' => null,
            'tipo_documento_id' => $request->tipo_documento_id,
            'user_id' => $request->user_id
        ]);
        return response()->json([
            'asignacion_id' => $asignacion->id,
            'oficio_id' => $asignacion->oficio_id,
            'oficio_anio' => $asignacion->oficio_anio,
            'created_at' => $asignacion->created_at,
            'name' => $request->name,
            'path' => $asignacion->path,
            'tipo_documento_id' => $asignacion->tipo_documento_id
        ],200);
    }

    public function pdf(AsignarPdfProvidenciaRequest $request, $id)
    {
        if(!$request->hasFile("pdf")) {
            return response()->json("Debe adjuntar un archivo pdf", 503);
        }

        $asignacion = Asignacion::findOrFail($id);

        if($asignacion->path != null) {
            \Storage::delete($asignacion->path);
        }
        $hash_pdf = "$request->oficio_id-";
        $hash_pdf = $hash_pdf . str_random(7); //str_replace("/", "", \Hash::make("$request->oficio_id-$request->oficio_anio"));
        $path = $request->file('pdf')->storeAs("public/providencias/$request->oficio_anio", "$hash_pdf.pdf");

        if($path != null) {
            $asignacion->path = $path;
            if($asignacion->save()) {
                return response()->json(["path" => $path], 200);
            } else {
                \Storage::delete($path);
                return response()->json("Ocurrió un error. Por favor intente más tarde", 503);
            }
        }
    }

    public function providenciasPendientes()
    {
        $providencias = DB::table('providencias')
        ->select(DB::raw('COUNT(asignaciones.id) as conteo'))
        ->leftJoin('asignaciones', function($join) {
            $join->on('providencias.id', '=', 'asignaciones.oficio_id');
            $join->on('providencias.anio', '=', 'asignaciones.oficio_anio')
            ->where('asignaciones.tipo_documento_id', '=', 4)
            ->where('asignaciones.path', '=', null);
        })
        ->first();
        return response()->json($providencias, 200);
    }
}
