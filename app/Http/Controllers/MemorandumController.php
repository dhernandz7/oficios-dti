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
            $join->on('memorandum.id', 'asignacion.oficio_id')
            ->where('asignacion.tipo_documento_id', 3);
        })
        ->leftJoin('users', function($join) {
            $join->on('asignacion.user_id', 'users.id');
        })
        ->leftJoin('documento', function($join) {
            $join->on('memorandum.id', 'documento.oficio_id')
            ->where('documento.tipo_documento_id', 3);
        })
        ->where('memorandum.anio', 2019)
        ->where('asignacion.tipo_documento_id', 3)
        ->select([
            'memorandum.id',
            'memorandum.anio',
            'asignacion.fecha_asignacion',
            'users.nombre',
            'documento.hash_oficio',
            'asignacion.tipo_documento_id'
        ])
        ->distinct()
        ->get();

        return response()->json(["data" => $memorandums], 200);
    }

    public function update(Request $request, $id)
    {
        return $request->id;
    }
}
