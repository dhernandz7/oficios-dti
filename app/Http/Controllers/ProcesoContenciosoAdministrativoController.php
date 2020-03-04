<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProcesoContenciosoAdministrativo;
use App\Http\Requests\CreateProcesoContenciosoAdministrativoRequest;
use App\Http\Requests\UpdateProcesoContenciosoAdministrativoRequest;

class ProcesoContenciosoAdministrativoController extends Controller
{
    public function index()
    {
    	$procesos = ProcesoContenciosoAdministrativo::join('', '')
        ->join('', '')
        ->join('', '')
        ->join('', '')
        ->select([
            ''
        ])
        ->get();

        return response()->json(['data' => $procesos], 200);
    }

    public function store(CreateProcesoContenciosoAdministrativoRequest $request)
    {
    	ProcesoContenciosoAdministrativo::create([
            '' => ''
        ]
        );

        return response()->json([
            '' => ''
        ], 200);
    }

    public function update(UpdateProcesoContenciosoAdministrativoRequest $request, $id)
    {
    	ProcesoContenciosoAdministrativo::update([

        ]);

        return response()->json([
        ], 200);
    }
}
