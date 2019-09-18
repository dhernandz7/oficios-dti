@extends('layouts.admin')

@section('titulo', 'Inicio')
@section('contenido')
@include('layouts.dashboard')
<div>
  <h1 class="jumbotron-heading"><i class="fa fa-newspaper mr-2"></i>Inicio</h1>
  <p class="lead text-muted">Sección de noticias</p>
  <hr>
  <br>
  <div class="card-deck">
    <div class="card">
      <img src="/images/fe.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">¿Qué es la firma electrónica avanzada?</h5>
        <p class="card-text text-justify">
          La firma electrónica avanzada es un conjunto de datos que se adjuntan a un mensaje electrónico, cuyo propósito es identificar al firmante como autor de ésta de manera única, como si se tratara de una firma manuscrita.
        </p>
        <a href="https://es.wikipedia.org/wiki/Firma_electr%C3%B3nica" target="_blank" class="btn btn-outline-primary"><i class="fa fa-link mr-2"></i>Más información</a>
      </div>
    </div>

    <div class="card">
      <img src="/images/digisign.jpg" class="card-img-top img-responsive" alt="...">
      <div class="card-body">
        <h5 class="card-title">Digisign</h5>
        <p class="card-text text-justify">
          Aplicación web que sirve para solicitar a uno o varios usuarios una firma, una validación o la autorización de un documento en formato <strong>.pdf</strong>.
        </p>
        <br>
        <br>
        <a href="https://rrhhfirmae.mineco.gob.gt/#/login" target="_blank" class="btn btn-outline-primary"><i class="fa fa-edit mr-2"></i>Firmar documento</a>
      </div>
    </div>

    <div class="card">
      <img src="/images/herramientas.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Herramientas</h5>
        <ul>
          <li><a href="https://www.4identity.eu/sign.php" target="_blank">Firmar documento pdf</a></li>
          <li><a href="https://www.uanataca.com/es/vol.html" target="_blank">Validador de firmas en línea</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection