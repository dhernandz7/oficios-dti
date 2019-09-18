@extends('layouts.admin')
@section('titulo', 'Asignación de rol')

@section('contenido')
<div class="row">
    <div class="col-md-12">
        @include('layouts.info')
        <button class="regresar btn btn-primary pull-right"><i class="fa fa-arrow-left fa-lg mr-2"></i>Regresar</button>
        <h1><i class="fa fa-check-square mr-2"></i>Asignar rol</h1>
        <h5>Usuario: <strong>{{$user->nombre1}} {{$user->nombre2}} {{$user->apellido1}} {{$user->apellido2}}</strong></h5>
        <hr>
        <br>
        <div class="table-responsive shadow-lg p-4 mb-5 bg-white rounded">
            {!! Form::model($user, ['route' => ['admin.actualizar.rol', $user->id], 'method' => 'PUT']) !!}
            <table class="table table-hover border" id="tbl_asignar_roles">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Id rol</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="text-center">Asignar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->description}}</td>
                        <td class="text-center">
                            <div class="custom-control custom-switch">
                                {{ Form::checkbox('roles[]', $role->id, null, ['class'=>'custom-control-input', 'id'=>"customSwitch$role->id"]) }}
                                <label class="custom-control-label" for="customSwitch{{$role->id}}"></label>
                                {{-- {{ Form::label("customSwitch$role->id","Activar", ['class'=>'custom-control-label', false]) }} --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary mt-5"><i class="fa fa-save fa-lg mr-2"></i>Guardar cambios</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('script')
$('#tbl_asignar_roles').DataTable({
lengthMenu: [[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "todos"]],
info: true,
autoWidth: false,
"language" : idioma_espanol
});
@endsection