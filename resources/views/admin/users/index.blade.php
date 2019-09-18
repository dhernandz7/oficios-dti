@extends('layouts.admin')

@section('titulo','Usuarios')

@section('contenido')
<div class="row">
    <div class="col-md-12">
        @can('users.create')
        <button class="nuevo btn btn-primary pull-right" data-toggle="modal" data-target="#modal_users">
            <i class="fa fa-user-plus fa-lg mr-1"></i>Agregar usuario
        </button>
        @endcan
        <h1><i class="fa fa-users mr-2"></i>Usuarios</h1>
        <p>Listado de usuarios del sistema SIC-029</p>
        <hr>
        <br>
        <div class="alert alert-success" role="alert" id="mensaje" style="display: none;"></div>
        <div class="table-responsive shadow-lg p-4 mb-5 bg-white rounded">
            <table class="table table-hover border" id="tbl_users">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Id usuario</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Nombre de usuario</th>
                        <th>Género</th>
                        <th>Estado</th>
                        <th class="text-right">Acción</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_users" tabindex="-1" role="dialog" aria-labelledby="label_modal_users" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_modal_users"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            {!! Form::open(['id'=>'form_users', 'method'=>'POST' , 'onsubmit' => 'event.preventDefault(); return false', 'autocomplete'=>'off']) !!}
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre1">Primer nombre</label><span class="text-danger ml-1">*</span>
                        <input id="nombre1" type="text" class="form-control" name="nombre1" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nombre2">Segundo nombre</label>
                        <input id="nombre2" type="text" class="form-control" name="nombre2">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        <label for="apellido1">Primer apellido</label><span class="text-danger ml-1">*</span>
                        <input id="apellido1" type="text" class="form-control" name="apellido1" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellido2">Segundo apellido</label>
                        <input id="apellido2" type="text" class="form-control" name="apellido2">
                    </div>
                </div>

                <div class="form-group">
                        <label for="email">Correo electrónico</label><span class="text-danger ml-1">*</span>
                        <input id="email" type="email" class="form-control" name="email">
                </div>
                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        <label for="dpi" class="control-label">DPI</label><span class="text-danger ml-1">*</span>
                        <input id="dpi" type="dpi" class="form-control" name="dpi" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Género</label><span class="text-danger ml-1">*</span>
                        <select class="form-control" name="genero_id" id="genero_id" required>
                            <option value="">Seleccione género</option>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        <label for="fecha_nacimiento">Fecha de nacimiento</label><span class="text-danger ml-1">*</span>
                        <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        {!! Form::label("viceministerio_id", "Viceministerio") !!}<span class="text-danger ml-1">*</span>
                        {!! Form::select("viceministerio_id", DB::table("viceministerios")->pluck("viceministerio", "id"), null, ["class" => "form-control", "placeholder" => "Seleccione viceministerio", "required"]) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        {!! Form::label("unidad_id", "Unidad Ejecutora") !!}<span class="text-danger ml-1">*</span>
                        {!! Form::select("unidad_id", DB::table("unidades")->pluck("unidad_ejecutora", "id"), null, ["class" => "form-control", "placeholder"=>"Seleccione unidad ejecutora" , "required"]) !!}
                    </div>
                    <div class="col-md-6 mb-3">
                        {!! Form::label("direccion_id", "Dirección o dependencia") !!}<span class="text-danger ml-1">*</span>
                        {!! Form::select("direccion_id", DB::table("direcciones")->pluck("direccion", "id"), null, ["class" => "form-control", "placeholder"=>"Seleccione una unidad ejecutora" , "required"]) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        {!! Form::label("ubicacion_id", "¿En dónde se encuenta ubicado?") !!}<span class="text-danger ml-1">*</span>
                        {!! Form::select("ubicacion_id", DB::table("ubicaciones")->pluck("ubicacion", "id"), null, ["class" => "form-control", "placeholder" => "Seleccione ubicación", "required"]) !!}
                    </div>
                    <div class="col-md-6 mb-3">
                        {!! Form::label("servicio_id", "¿Qué tipo de servicios prestará?") !!}<span class="text-danger ml-1">*</span>
                        {!! Form::select("servicio_id", DB::table("servicios")->pluck("tipo_servicio", "id"), null, ["class" => "form-control", "placeholder" => "Seleccione tipo de servicio", "required"]) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        {!! Form::label("tipo_usuario_id", "Tipo de usuario") !!}<span class="text-danger ml-1">*</span>
                        {!! Form::select("tipo_usuario_id", DB::table("tipo_usuario")->pluck("tipo_usuario", "id"), null, ["class" => "form-control", "placeholder" => "Seleccione tipo el usuario", "required"]) !!}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nombre1">Estado</label>
                        <select id="email_verified_at" name="email_verified_at" class="form-control" required>
                            <option value="">Seleccione estado</option>
                            <option value="autorizado">Autorizado</option>
                            <option value="pendiente">Pendiente de autorizar</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="boton_guardar_usuario"><i class="fa fa-save fa-lg mr-2"></i>Registar usuario</button>
                <button type="submit" class="btn btn-primary" id="boton_editar_usuario"><i class="fa fa-save fa-lg mr-2"></i>Actualizar usuario</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg mr-2"></i>Cerrar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="modal_users_eliminar" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-trash fa-lg mr-2"></i>Eliminar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Esta apunto de eliminar al usuario: <strong id="info-eliminar-usuario"></strong>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="boton_eliminar_user"><i class="fa fa-trash fa-lg mr-2"></i>Eliminar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg mr-2"></i>Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="/js/crud/users.js"></script>
@endsection
@section('script')
eventoEditarUser();
eventoEliminarUser();
clickBotonNuevoUser();
clickBotonEditarUser();
clickBotonGuardarUser();
clickBotonEliminarUser();

setSelectDireccion('#viceministerio_id', '#direccion_id', '/public/getDirecciones');
@endsection