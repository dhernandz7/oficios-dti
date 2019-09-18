@extends('layouts.admin')
@section('titulo','Roles')
@section('contenido')
<div class="row">
    <div class="col-md-12">
        @include('layouts.info')
        <a href="/admin/roles/create" class="btn btn-primary pull-right text-white">
            <i class="fa fa-plus-circle fa-lg mr-2"></i>Registrar rol
        </a>
        <h1><i class="fa fa-lock mr-2"></i>Roles</h1>
        <p>Listado de roles en el sistema SIC-029</p>
        <hr>
        <br>
        <div class="alert alert-success" role="alert" id="mensaje" style="display: none;"></div>
        <div class="table-responsive shadow-lg p-4 mb-5 bg-white rounded">
            <table class="table table-hover border" id="tbl_roles">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Id rol</th>
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
@endsection
@section('scripts')
<script src="/js/crud/roles.js"></script>
@endsection