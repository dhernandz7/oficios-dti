<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMemorandumRequest;
use App\Http\Requests\AsignarMemorandumRequest;
use App\Http\Requests\AsignarPdfMemorandumRequest;
use App\Memorandum;
use App\Asignacion;
use DB;

class MemorandumController extends Controller
{
    public function index()
    {
        $memorandums = Memorandum::
        leftJoin('asignaciones', function($join) {
            $join->on('memorandums.id', '=', 'asignaciones.oficio_id');
            $join->on('memorandums.anio', '=', 'asignaciones.oficio_anio')
            ->where('asignaciones.tipo_documento_id', '=', 3);
        })
        ->leftJoin('users', 'asignaciones.user_id','users.id')
        //->where('memorandums.anio', 2019)
        ->select([
            'asignaciones.id as asignacion_id',
            'memorandums.id as oficio_id',
            'memorandums.anio as oficio_anio',
            'asignaciones.created_at',
            'users.name',
            'users.iniciales',
            'asignaciones.path',
            'asignaciones.tipo_documento_id',
            'asignaciones.user_id'
        ])
        ->orderBy('memorandums.id')
        ->get();

        return response()->json(["data" => $memorandums], 200);
    }

    public function reservarAutomaticamente(StoreMemorandumRequest $request)
    {
        $memorandum = Memorandum::create([
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
            'iniciales' => $request->iniciales,
            'path' => $asignacion->path,
            'tipo_documento_id' => $asignacion->tipo_documento_id,
            'user_id' => $asignacion->user_id
        ],200);
    }

    public function reservar(AsignarMemorandumRequest $request)
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

    public function pdf(AsignarPdfMemorandumRequest $request, $id)
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
        $path = $request->file('pdf')->storeAs("public/memorandums/$request->oficio_anio", "$hash_pdf.pdf");

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

    public function memorandumsPendientes()
    {
        $memorandums = DB::table('memorandums')
        ->select(DB::raw('COUNT(asignaciones.id) as conteo'))
        ->leftJoin('asignaciones', function($join) {
            $join->on('memorandums.id', '=', 'asignaciones.oficio_id');
            $join->on('memorandums.anio', '=', 'asignaciones.oficio_anio')
            ->where('asignaciones.tipo_documento_id', '=', 3)
            ->where('asignaciones.path', '=', null);
        })
        ->first();
        return response()->json($memorandums, 200);
    }
}
