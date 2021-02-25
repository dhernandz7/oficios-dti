<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReporteController extends Controller
{
    public function counteoDelAnio()
    {
    	$anio_actual = date('Y');
    	return response()->json([
    		'oficios' => DB::table('asignaciones')->where('oficio_anio', $anio_actual)->where('tipo_documento_id', 1)->count(),
    		'dictamenes' => DB::table('asignaciones')->where('oficio_anio', $anio_actual)->where('tipo_documento_id', 2)->count(),
    		'memorandums' => DB::table('asignaciones')->where('oficio_anio', $anio_actual)->where('tipo_documento_id', 3)->count(),
    		'providencias' => DB::table('asignaciones')->where('oficio_anio', $anio_actual)->where('tipo_documento_id', 4)->count()
    	], 200);
    }
}
