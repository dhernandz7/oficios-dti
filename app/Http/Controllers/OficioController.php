<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOficioRequest;
use App\Http\Requests\AsignarOficioRequest;
use App\Http\Requests\AsignarPdfOficioRequest;
use App\Oficio;
use App\Asignacion;
use DB;

class OficioController extends Controller
{
    public function index()
    {
        $oficios = Oficio::
        leftJoin('asignaciones', function($join) {
            $join->on('oficios.id', '=', 'asignaciones.oficio_id');
            $join->on('oficios.anio', '=', 'asignaciones.oficio_anio')
            ->where('asignaciones.tipo_documento_id', '=', 1);
        })
        ->leftJoin('users', 'asignaciones.user_id','users.id')
        //->where('oficios.anio', 2019)
        ->select([
            'asignaciones.id as asignacion_id',
            'oficios.id as oficio_id',
            'oficios.anio as oficio_anio',
            'asignaciones.created_at',
            'users.name',
            'asignaciones.path',
            'asignaciones.tipo_documento_id'
        ])
        ->orderBy('oficios.id')
        ->get();

        return response()->json(["data" => $oficios], 200);
    }

    public function reservarAutomaticamente(StoreOficioRequest $request)
    {
        $oficio = Oficio::create([
            'anio' => date('Y')
        ]);

        $asignacion = Asignacion::create([
            'oficio_id' => $oficio->id,
            'oficio_anio' => $oficio->anio,
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

    public function reservar(AsignarOficioRequest $request)
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

    public function pdf(AsignarPdfOficioRequest $request, $id)
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
        $path = $request->file('pdf')->storeAs("public/oficios/$request->oficio_anio", "$hash_pdf.pdf");

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

    public function oficiosPendientes()
    {
        $oficios = DB::table('oficios')
        ->select(DB::raw('COUNT(asignaciones.id) as conteo'))
        ->leftJoin('asignaciones', function($join) {
            $join->on('oficios.id', '=', 'asignaciones.oficio_id');
            $join->on('oficios.anio', '=', 'asignaciones.oficio_anio')
            ->where('asignaciones.tipo_documento_id', '=', 1)
            ->where('asignaciones.path', '=', null);
        })
        ->first();
        return response()->json($oficios, 200);
    }
}
