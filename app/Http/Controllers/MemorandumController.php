<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Memorandum;

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

    public function asignar(Request $request, $id, $anio)
    {
        $request->validate([
            'id' => 'unique:memorandum',
            'anio' => 'unique:memorandum'
        ]);
        return response()->json($request, 500);
    }
    public function asignarAutomaticamente(Request $request)
    {
        // Para generar un memorándum y asignarle el usuario automáticamente
    }
}
