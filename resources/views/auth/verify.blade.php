@extends('layouts.admin')

@section('titulo', 'Usuario no autorizado')

@section('contenido')
@if (session('resent'))
<div class="alert alert-success lead" role="alert">
    Se le ha enviado un correo electrónico al delegado de Recursos Humanos para que agilice la habilitación de su usuario.
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <h1>Usuario no autorizado
        <p class="lead">Lo sentimos, usted no está autorizado para acceder a esta página.</p>
        <a class="btn btn-outline-primary" href="/email/resend"><i class="fa fa-send fa-lg mr-2"></i>Solicitar la autorización de mi usuario</a>
    </div>
</div>
@endsection
