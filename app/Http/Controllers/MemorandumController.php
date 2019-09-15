<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AsignarMemorandumRequest;
use App\Http\Requests\AsignarPdfMemorandumRequest;
use App\Memorandum;
use App\Asignacion;
use App\Documento;

class MemorandumController extends Controller
{
    public function index()
    {
        $memorandums = Memorandum::
        leftJoin('asignacion', function($join) {
            $join->on('memorandum.id', '=', 'asignacion.oficio_id');
            $join->on('memorandum.anio', '=', 'asignacion.oficio_anio')
            ->where('asignacion.tipo_documento_id', '=', 3);
        })
        ->leftJoin('users', function($join) {
            $join->on('asignacion.user_id', '=', 'users.id');
        })
        ->leftJoin('documento', function($join) {
            $join->on('memorandum.id', '=', 'documento.oficio_id');
            $join->on('memorandum.anio', '=', 'documento.oficio_anio')
            ->where('documento.tipo_documento_id', '=',3);
        })
        //->where('memorandum.anio', 2019)
        ->select([
            'memorandum.id',
            'memorandum.anio',
            'asignacion.fecha_asignacion',
            'users.nombre',
            'documento.direccion_server',
            'asignacion.tipo_documento_id'
        ])
        ->orderBy('memorandum.id')
        ->get();

        return response()->json(["data" => $memorandums], 200);
    }

    public function asignar(AsignarMemorandumRequest $request, $id, $anio)
    {
        //dd($request->request);
        /*
        $asignacion = Asignacion::create([
            'oficio_id' => $id,
            'oficio_anio' => $anio,
            'correspondencia_ref' => '',
            'personal' => $request->nombre,
            'fecha_asignacion' => now(),
            'activo' => true,
            'tipo_documento_id' => $request->tipo_documento_id,
            'user_id' => $request->user_id
        ]);
        */
        $asignacion = [
            "nombre"=> "Yesenia Sureydy Bravo Gómez",
            "fecha_asignacion" => date('Y-m-d H:i:s')
        ];
        return response()->json($asignacion, 200);
    }

    public function asignarAutomaticamente(Request $request)
    {
        // Para generar un memorándum y asignarle el usuario automáticamente
    }

    public function pdf(AsignarPdfMemorandumRequest $request, $id, $anio)
    {
        // Ejecutar procedimiento y devolver la ruta del archivo,
        // Verficar si es factible ejecutar el procedimiento
        $request->file('pdf')->store("public/memorandum");
        $path = "url_del_pdf";
        return response()->json(["direccion_server" => $path], 200);
    }
}
