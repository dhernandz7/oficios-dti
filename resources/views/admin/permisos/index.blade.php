@extends('layouts.admin')
@section('titulo','Permisos')
@section('contenido')
<div class="row">
	<div class="col-md-12">
		<button class="nuevo btn btn-primary pull-right" data-toggle="modal" data-target="#modal_permisos">
			<i class="fa fa-plus-circle fa-lg mr-2"></i>Agregar permiso
		</button>
		<h1><i class="fa fa-lock mr-2"></i>Permisos</h1>
		<p>Listado de permisos dentro del sistema SIC-029</p>
		<hr>
		<br>
		<div class="alert alert-success" role="alert" id="mensaje" style="display: none;"></div>
		<div class="table-responsive shadow-lg p-4 mb-5 bg-white rounded">
			<table class="table table-hover border" id="tbl_permisos">
				<thead class="bg-dark text-white">
					<tr>
						<th>Id permiso</th>
						<th>Nombre</th>
						<th>Ruta</th>
						<th>Descripción</th>
						<th class="text-right">Acción</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_permisos" tabindex="-1" role="dialog" aria-labelledby="label_modal_permisos" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal_permisos"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			{!! Form::open(['id'=>'form_permisos', 'method'=>'POST' , 'onsubmit' => 'event.preventDefault(); return false', 'autocomplete'=>'off']) !!}
			<div class="modal-body">
				<div class="form-group">
					<label for="name">Nombre del permiso</label><span class="text-danger ml-1">*</span>
					<input id="name" type="text" class="form-control" name="name" required>
				</div>
				<div class="form-group">
					<label for="slug">Slug (ruta)</label><span class="text-danger ml-1">*</span>
					<input id="slug" type="text" class="form-control" name="slug" required>
				</div>

				<div class="form-group">
					<label for="description">Descripción</label><span class="text-danger ml-1">*</span>
					<input id="description" type="text" class="form-control" name="description" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="boton_guardar_permiso"><i class="fa fa-save fa-lg mr-2"></i>Registar permiso</button>
				<button type="submit" class="btn btn-primary" id="boton_editar_permiso"><i class="fa fa-save fa-lg mr-2"></i>Actualizar permiso</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg mr-2"></i>Cerrar</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<div class="modal fade" id="modal_permisos_eliminar" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Eliminar permiso</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				Está a punto de eliminar el permiso: <strong id="info-eliminar-permiso"></strong>?
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" id="boton_eliminar_permiso"><i class="fa fa-trash fa-lg mr-2"></i>Eliminar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg mr-2"></i>Cerrar</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="/js/crud/permisos.js"></script>
@endsection
@section('script')
eventoEditarPermiso();
eventoEliminarPermiso();
clickBotonNuevoPermiso();
clickBotonEditarPermiso();
clickBotonGuardarPermiso();
clickBotonEliminarPermiso();
@endsection