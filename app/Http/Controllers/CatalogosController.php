<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProceso;
use App\PlazoAudiencia;

class CatalogosController extends Controller
{
    public function tiposDeProcesos()
    {
    	$tiposDeProcesos = TipoProceso::select('id', 'tipo_proceso')->get();
    	return response()->json($tiposDeProcesos,200);
    }

    public function plazosDeAudiencias()
    {
    	$plazosDeAudiencias = PlazoAudiencia::select('id', 'plazo_audiencia')->get();
    	return response()->json($plazosDeAudiencias,200);
    }
}
