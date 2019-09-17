@extends('layouts.session')

@section('titulo','Reinicio de contraseña')

@section('contenido')
<form class="form-signin p-4 shadow bg-white rounded" method="POST" action="/password/reset">
    <div class="text-center mt-3">
        <i class="fa fa-lock fa-5x text-dark"></i>
        <h1 class="h3 mb-3 font-weight-normal">Reinicio de contraseña<br><small>{{config('app.name')}}</small></h1>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
    </div>
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-label-group">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Correo electrónico" required autofocus>
        <label for="email">Correo electrónico</label>
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-label-group">
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ $password ?? old('password') }}" placeholder="Contraseña" required>
        <label for="password">Contraseña</label>
        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-label-group">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required>
        <label for="email">Confirmar contraseña</label>
    </div>
    <div class="form-label-group">
        <button type="submit" class="btn btn-primary btn-block  ">
            <i class="fa fa-check-circle fa-lg mr-2"></i>Actualizar contraseña
        </button>
    </div>
    <div class="text-center mt-3">
        <a class="btn btn-link text-center link" href="/login">Iniciar sesión</a>
        <a class="btn btn-link text-center link" href="/password/reset">Solicitar reestablecimiento de contraseña</a>
    </div>
</form>
@endsection
