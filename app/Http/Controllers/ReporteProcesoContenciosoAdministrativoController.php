<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProcesoContenciosoAdministrativo;

class ReporteProcesoContenciosoAdministrativoController extends Controller
{
    public function index()
    {
    	return view('layouts.reporte');
    }

    public function getProcesos(Request $request)
    {
    	$procesos = ProcesoContenciosoAdministrativo::where()
    }


}
