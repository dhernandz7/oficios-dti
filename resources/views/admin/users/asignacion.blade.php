@extends('layouts.admin')
@section('titulo','Usuarios')
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <a href="/admin/users" class="btn btn-primary pull-right">
            Administrar usuarios<i class="fa fa-users fa-lg ml-3"></i>
        </a>
        <h1>Usuarios</h1>
        <br>
        <div class="alert alert-success" role="alert" id="mensaje" style="display: none;"></div>
        <div class="table-responsive">
            <table class="table table-hover border" id="tbl_users">
                <thead>
                    <tr>
                        <th>Id usuario</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Dpi</th>
                        <th>Género</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection()

@section('scripts')
<script src="/js/crud/asignacion.js"></script>
@endsection