<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
    	$users = User::withTrashed()->get();
    	return response()->json(["data" => $users], 200);
    }

    public function update(Request $request, $id)
    {
    	$user = User::findOrFail($id);
    	// Setear atributos del usuario y hacer la actualización.
    	return response()->json($user, 200);
    }

    public function destroy($id)
    {
    	$delete = User::delete($id);

    	if(!$delete) {
    		return response()->json("No se ha podido eliminar el usuario, por favor intente más tarde", 503);
    	}

    	return response()->json("Usuario eliminado correctamente", 200);
    }
}
