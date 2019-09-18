<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show($id)
    {
    	$user = User::
    	join('departamentos', 'users.departamento_id', 'departamentos.id')
        ->join('generos', 'users.genero_id', 'generos.id')
        ->where('users.id',$id)
        ->select([
            'users.dpi',
            'users.name',
            'users.fecha_nacimiento',
            'generos.genero',
            'users.genero_id',
            'users.email',
            'users.username',
            'departamentos.departamento',
            'users.departamento_id'
        ])
        ->first();
        return response()->json($user, 200);
    }
}
