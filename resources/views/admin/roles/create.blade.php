@extends('layouts.admin')
@section('titulo','Editar rol')

@section('contenido')
<div class="row">
    <div class="col-md-12">
        @include('layouts.info')
        <button class="regresar btn btn-primary pull-right"><i class="fa fa-arrow-left fa-lg mr-2"></i>Regresar</button>
        <h1><i class="fa fa-plus-circle mr-2"></i>Nuevo rol</h1>
        <p>Registrar nuevo rol</p>
        <hr>
        <br>
        {{ Form::open(['route' => 'admin.roles.store', 'autocomplete'=>'off']) }}
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="name">Nombre del rol</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="slug">Ruta</label>
                <input type="text" id="slug" name="slug" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Breve descripción</label>
            <textarea class="form-control" id="description" rows="3"></textarea>
        </div>
        <br>
        <div class="form-group">
            <h1 class="text-info">Permiso especial</h1>
            <label>{{ Form::radio('special', 'all-access') }} Acceso total</label><br>
            <label>{{ Form::radio('special', 'no-access') }} Ningún acceso</label><br>
        </div>
        <br>
        <h1>Listado de permisos</h1>
        <br>
        <div class="table-responsive shadow-lg p-4 mb-5 bg-white rounded">
            <table class="table table-hover border" id="tbl_permisos">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Id permiso</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="text-center">Asignar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td class="text-center">
                            <div class="custom-control custom-switch">
                                {{ Form::checkbox('permissions[]', $permission->id, null, ['class'=>'custom-control-input', 'id'=>"customSwitch$permission->id"]) }}
                                <label class="custom-control-label" for="customSwitch{{$permission->id}}"></label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-lg mr-2"></i>Guardar rol</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('script')
$('#tbl_permisos').DataTable({
    lengthMenu: [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "todos"]],
    info: true,
    autoWidth: false,
    "language" : idioma_espanol
});
@endsection