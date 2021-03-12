@component('mail::message')
# {{$user->genero_id == '1' ? 'Estimado' : 'Estimada'}} {{$user->name}}

Usted ha recibido este correo porque en el sistema **{{config('app.name')}}**, tiene <b>{{count($documentos)}}</b> documento(s) pendiente(s) de adjuntar:

@component('mail::table')
| Tipo de documento | Correlativo     |
|:------------------|:----------------|
@foreach($documentos as $documento)
| {{$documento->tipo_documento}} {{$documento->oficio_anio}}           | DTI{{$documento->prefijo ? "-". $documento->prefijo : ''}}-{{str_pad($documento->oficio_id, 3, "0", STR_PAD_LEFT)}}-{{$documento->oficio_anio}} |
@endforeach
@endcomponent

@component('mail::button', ['url' => config('app.url') . "/dashboard"])
Ir al sistema
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
