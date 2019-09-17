@extends('layouts.session')

@section('titulo','Registrar usuario')

@section('contenido')
<form class="card form-signin-extend p-4 shadow bg-white rounded" method="POST" action="/register" autocomplete="off">
    <div class="text-center">
        <i class="fa fa-user-plus fa-4x mb-3"></i>
        <h1 class="h3 mb-3 font-weight-normal">Registrar usuario<br><small>{{config('app.name')}}</small></h1>
    </div>
    <hr>
    @csrf
    <div class="form-group row">
        <div class="col-md-6">
            <label for="nombre1">Primer nombre</label><span class="text-danger ml-1">*</span>
            <input id="nombre1" type="text" class="form-control{{ $errors->has('nombre1') ? ' is-invalid' : '' }}" name="nombre1" value="{{ old('nombre1') }}" required autofocus>
            @if ($errors->has('nombre1'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nombre1') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-6">
            <label for="nombre2">Segundo nombre</label>
            <input id="nombre2" type="text" class="form-control{{ $errors->has('nombre2') ? ' is-invalid' : '' }}" name="nombre2" value="{{ old('nombre2') }}">

            @if ($errors->has('nombre2'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nombre2') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">
            <label for="apellido1">Primer apellido</label><span class="text-danger ml-1">*</span>
            <input id="apellido1" type="text" class="form-control{{ $errors->has('apellido1') ? ' is-invalid' : '' }}" name="apellido1" value="{{ old('apellido1') }}" required>

            @if ($errors->has('apellido1'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('apellido1') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-6">
            <label for="apellido2">Segundo apellido</label>
            <input id="apellido2" type="text" class="form-control{{ $errors->has('apellido2') ? ' is-invalid' : '' }}" name="apellido2" value="{{ old('apellido2') }}">

            @if ($errors->has('apellido2'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('apellido2') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="email">Correo electrónico</label><span class="text-danger ml-1">*</span>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group row">
        <div class="col-md-6 mb-3">
            <label for="dpi" class="control-label">DPI</label><span class="text-danger ml-1">*</span>
            <input id="dpi" type="dpi" class="form-control{{ $errors->has('dpi') ? ' is-invalid' : '' }}" name="dpi" value="{{ old('dpi') }}" required>
            <span class="{{ $errors->has('dpi') ? 'invalid-feedback' : '' }}" role="alert">
                @if ($errors->has('dpi'))
                <strong>{{ $errors->first('dpi') }}</strong>
                @endif
            </span>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email">Género</label><span class="text-danger ml-1">*</span>
            <select class="form-control{{ $errors->has('genero_id') ? ' is-invalid' : '' }}" name="genero_id" id="genero_id" required>
                <option value="">Seleccione género</option>
                <option value="1" {{ old('genero_id') == 1 ? 'selected' : '' }}>
                    Masculino
                </option>
                <option value="2" {{ old('genero_id') == 2 ? 'selected' : '' }}>
                    Femenino
                </option>
            </select>
            @if ($errors->has('genero_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('genero_id') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6 mb-3">
            <label for="fecha_nacimiento">Fecha de nacimiento</label><span class="text-danger ml-1">*</span>
            <input id="fecha_nacimiento" type="date" class="form-control{{ $errors->has('fecha_nacimiento') ? ' is-invalid' : '' }}" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>

            @if ($errors->has('fecha_nacimiento'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label("viceministerio_id", "Viceministerio") !!}<span class="text-danger ml-1">*</span>
            {!! Form::select("viceministerio_id", DB::table("viceministerios")->pluck("viceministerio", "id"), null, ["class" => "form-control", "placeholder" => "Seleccione viceministerio", "required"]) !!}
            @if ($errors->has('viceministerio_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('viceministerio_id') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6 mb-3">
            {!! Form::label("unidad_id", "Unidad Ejecutora") !!}<span class="text-danger ml-1">*</span>
            {!! Form::select("unidad_id", DB::table("unidades")->pluck("unidad_ejecutora", "id"), null, ["class" => "form-control", "placeholder"=>"Seleccione unidad ejecutora" , "required"]) !!}
            @if ($errors->has('unidad_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('unidad_id') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-6 mb-3">
            <label for="direccion_id">Dirección o dependencia</label>
            <select name="direccion_id" id="direccion_id" class="form-control">
                <option value="">Seleccione una unidad ejecutora</option>
            </select>
            @if ($errors->has('direccion_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('direccion_id') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6 mb-3">
            {!! Form::label("ubicacion_id", "¿En dónde se encuenta ubicado?") !!}<span class="text-danger ml-1">*</span>
            {!! Form::select("ubicacion_id", DB::table("ubicaciones")->pluck("ubicacion", "id"), null, ["class" => "form-control", "placeholder" => "Seleccione ubicación", "required"]) !!}
            @if ($errors->has('ubicacion_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ubicacion_id') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label("servicio_id", "¿Qué tipo de servicios prestará?") !!}<span class="text-danger ml-1">*</span>
            {!! Form::select("servicio_id", DB::table("servicios")->pluck("tipo_servicio", "id"), null, ["class" => "form-control", "placeholder" => "Seleccione tipo de servicio", "required"]) !!}
            @if ($errors->has('servicio_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('servicio_id') }}</strong>
            </span>
            @endif
        </div>
    </div>    
    @guest()
    <div class="form-group row">
        <div class="col-md-6 mb-3">
            <label for="password">Contraseña</label><span class="text-danger ml-1">*</span>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-6 mb-3">
            <label for="password-confirm">Confirmar contraseña</label><span class="text-danger ml-1">*</span>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>
    @endguest
    <div class="text-center">
        <button type="submit" class="btn btn-primary m-2">Registrar usuario<i class="fa fa-floppy-o fa-lg ml-2"></i></button>
        <a class="btn btn-primary m-2" href="/login">Iniciar sesión<i class="fa fa-sign-in fa-lg ml-2"></i></a>
    </div>
</form>
@endsection

@section('script')
<script src="/js/app.js"></script>
<script>
    $(document).ready(function(){
        setSelectDireccion('#viceministerio_id', '#direccion_id', '/public/getDirecciones');
    });

    function setSelectDireccion(idSelectPadre, idSelectHijo, ruta) {
        $(idSelectPadre).change(event => {
            $.get(`${ruta}/${event.target.value}`, function (direcciones) {
                cadena = "<option value=''>Seleccione dirección o dependencia</option>";
                direcciones.forEach(direccion => {
                    cadena += `<option value="${direccion.id}">${direccion.direccion}</option>`;
                });
                $(idSelectHijo).html(cadena);
            });
        });
    }
    
    function cuiIsValid(cui) {
        /*var console = window.console;*/
        if (!cui) {
            /*console.log("CUI vacío");*/
            return true;
        }

        var cuiRegExp = /^[0-9]{4}\s?[0-9]{5}\s?[0-9]{4}$/;

        if (!cuiRegExp.test(cui)) {
            /*console.log("CUI con formato inválido");*/
            return false;
        }

        cui = cui.replace(/\s/, '');
        var depto = parseInt(cui.substring(9, 11), 10);
        var muni = parseInt(cui.substring(11, 13));
        var numero = cui.substring(0, 8);
        var verificador = parseInt(cui.substring(8, 9));

    // Se asume que la codificación de Municipios y 
    // departamentos es la misma que esta publicada en 
    // http://goo.gl/EsxN1a

    // Listado de municipios actualizado segun:
    // http://goo.gl/QLNglm

    // Este listado contiene la cantidad de municipios
    // existentes en cada departamento para poder 
    // determinar el código máximo aceptado por cada 
    // uno de los departamentos.
    var munisPorDepto = [ 
    /* 01 - Guatemala tiene:      */ 17 /* municipios. */, 
    /* 02 - El Progreso tiene:    */  8 /* municipios. */, 
    /* 03 - Sacatepéquez tiene:   */ 16 /* municipios. */, 
    /* 04 - Chimaltenango tiene:  */ 16 /* municipios. */, 
    /* 05 - Escuintla tiene:      */ 13 /* municipios. */, 
    /* 06 - Santa Rosa tiene:     */ 14 /* municipios. */, 
    /* 07 - Sololá tiene:         */ 19 /* municipios. */, 
    /* 08 - Totonicapán tiene:    */  8 /* municipios. */, 
    /* 09 - Quetzaltenango tiene: */ 24 /* municipios. */, 
    /* 10 - Suchitepéquez tiene:  */ 21 /* municipios. */, 
    /* 11 - Retalhuleu tiene:     */  9 /* municipios. */, 
    /* 12 - San Marcos tiene:     */ 30 /* municipios. */, 
    /* 13 - Huehuetenango tiene:  */ 32 /* municipios. */, 
    /* 14 - Quiché tiene:         */ 21 /* municipios. */, 
    /* 15 - Baja Verapaz tiene:   */  8 /* municipios. */, 
    /* 16 - Alta Verapaz tiene:   */ 17 /* municipios. */, 
    /* 17 - Petén tiene:          */ 14 /* municipios. */, 
    /* 18 - Izabal tiene:         */  5 /* municipios. */, 
    /* 19 - Zacapa tiene:         */ 11 /* municipios. */, 
    /* 20 - Chiquimula tiene:     */ 11 /* municipios. */, 
    /* 21 - Jalapa tiene:         */  7 /* municipios. */, 
    /* 22 - Jutiapa tiene:        */ 17 /* municipios. */ 
    ];
    
    if (depto === 0 || muni === 0)
    {
        /*console.log("CUI con código de municipio o departamento inválido.");*/
        return false;
    }
    
    if (depto > munisPorDepto.length)
    {
        /*console.log("CUI con código de departamento inválido.");*/
        return false;
    }
    
    if (muni > munisPorDepto[depto -1])
    {
        /*console.log("CUI con código de municipio inválido.");*/
        return false;
    }
    
    // Se verifica el correlativo con base 
    // en el algoritmo del complemento 11.
    var total = 0;
    
    for (var i = 0; i < numero.length; i++)
    {
        total += numero[i] * (i + 2);
    }
    
    var modulo = (total % 11);
    
    /*console.log("CUI con módulo: " + modulo);*/
    return modulo === verificador;
}

$('#dpi').bind('change paste keyup', function (e) {
    var $this = $(this);
    var $next = $this.next();
    var cui = $this.val();

    if (cui && cuiIsValid(cui)) {
        $this.removeClass('is-invalid');
        $next.addClass('invalid-feedback');
        $this.addClass('is-valid');
    } else if (cui) {
        $this.addClass('is-invalid');
        $next.addClass('invalid-feedback');
        $next.html('<strong>El dpi es invalido</strong>');
        
    } else {
        $this.removeClass('is-invalid');
        $next.html('');
        $this.removeClass('is-valid');
        $next.addClass('is-invalid');
    }
});
</script>
@endsection
