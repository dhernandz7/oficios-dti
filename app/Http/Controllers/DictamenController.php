<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDictamenRequest;
use App\Http\Requests\AsignarDictamenRequest;
use App\Http\Requests\AsignarPdfDictamenRequest;
use App\Dictamen;
use App\Asignacion;
use DB;

class DictamenController extends Controller
{
    public function index()
    {
        $dictamenes = Dictamen::
        leftJoin('asignaciones', function($join) {
            $join->on('dictamenes.id', '=', 'asignaciones.oficio_id');
            $join->on('dictamenes.anio', '=', 'asignaciones.oficio_anio')
            ->where('asignaciones.tipo_documento_id', '=', 2);
        })
        ->leftJoin('users', 'asignaciones.user_id','users.id')
        //->where('dictamenes.anio', 2019)
        ->select([
            'asignaciones.id as asignacion_id',
            'dictamenes.id as oficio_id',
            'dictamenes.anio as oficio_anio',
            'asignaciones.created_at',
            'users.name',
            'users.iniciales',
            'asignaciones.path',
            'asignaciones.tipo_documento_id',
            'asignaciones.user_id'
        ])
        ->orderBy('dictamenes.id')
        ->get();

        return response()->json(["data" => $dictamenes], 200);
    }

    public function reservarAutomaticamente(StoreDictamenRequest $request)
    {
        $dictamen = Dictamen::create([
            'anio' => date('Y')
        ]);

        $asignacion = Asignacion::create([
            'oficio_id' => $dictamen->id,
            'oficio_anio' => $dictamen->anio,
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
            'iniciales' => $request->iniciales,
            'path' => $asignacion->path,
            'tipo_documento_id' => $asignacion->tipo_documento_id,
            'user_id' => $asignacion->user_id
        ],200);
    }

    public function reservar(AsignarDictamenRequest $request)
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
            'iniciales' => $request->iniciales,
            'path' => $asignacion->path,
            'tipo_documento_id' => $asignacion->tipo_documento_id,
            'user_id' => $asignacion->user_id
        ],200);
    }

    public function pdf(AsignarPdfDictamenRequest $request, $id)
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
        $path = $request->file('pdf')->storeAs("public/dictamen/$request->oficio_anio", "$hash_pdf.pdf");

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

    public function dictamenesPendientes()
    {
        $dictamenes = DB::table('dictamenes')
        ->select(DB::raw('COUNT(asignaciones.id) as conteo'))
        ->leftJoin('asignaciones', function($join) {
            $join->on('dictamenes.id', '=', 'asignaciones.oficio_id');
            $join->on('dictamenes.anio', '=', 'asignaciones.oficio_anio')
            ->where('asignaciones.tipo_documento_id', '=', 2)
            ->where('asignaciones.path', '=', null);
        })
        ->first();
        return response()->json($dictamenes, 200);
    }
}
