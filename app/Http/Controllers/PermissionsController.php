<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index()
    {
        return view('admin.permisos.index');
    }

    public function getPermisos()
    {
        return datatables()->of(Permission::all())->make(true);
    }

    public function store(PermissionRequest $request)
    {
        return response()->json(Permission::create($request->all()),200);
    }

    public function update(PermissionUpdateRequest $request, $id)
    {
        $permiso = Permission::find($id);
        $permiso->update($request->all());
        return response()->json($permiso,200);
    }

    public function destroy($id)
    {
        return response()->json(Permission::find($id)->delete(),200);
    }
}
