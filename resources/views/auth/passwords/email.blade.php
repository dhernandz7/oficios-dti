@extends('layouts.session')

@section('titulo','Solicitud de reinicio de contraseña')

@section('contenido')
<form class="form-signin p-4 shadow bg-white rounded" method="POST" action="/password/email">
    {{ csrf_field() }}
    <div class="text-center mt-3">
        <i class="fa fa-lock fa-5x text-dark"></i>
        <h1 class="h3 mb-3 font-weight-normal">Solicitud de reinicio de contraseña<br><small>{{config('app.name')}}</small></h1>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
    </div>
    <div class="form-label-group">
        <input id="email" name="email" value="{{ old('email') }}" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Correo electrónico" required>
        <label for="email">Correo electrónico</label>
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-label-group">
        <button type="submit" class="btn btn-primary btn-block  ">
            <i class="fa fa-send fa-lg mr-2"></i>Enviar solicitud
        </button>
    </div>
    <div class="text-center mt-3">
        <a class="btn btn-link text-center link" href="/login">Iniciar sesión</a>
        <!-- <a class="btn btn-link text-center link" href="{{ route('register') }}">Registrar usuario</a> -->
    </div>
    <!-- <p class="mt-5 mb-3 text-muted text-center">&copy; 2018-2019</p> -->
</form>
@endsection
