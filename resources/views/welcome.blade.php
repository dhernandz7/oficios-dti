<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/cover.css">
</head>
<body class="bg-mineco text-center text-white">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">
                    <img class="img" src="/img/logo.png" width="100">
                </h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="#">Inicio</a>
                    <a href="/oficios" class="nav-link">Oficios</a>
                    <a href="/dictamenes" class="nav-link">Dictámenes</a>
                    <a href="/memorandums" class="nav-link">Memorándum</a>
                </nav>
            </div>
        </header>
        <main role="main" class="inner cover">
            <h1 class="cover-heading">Bienvenido</h1>
            <p class="lead">
                Sistema para gestión de oficios, memorándum y dictámenes de la Dirección de Tecnologías de la Información
            </p>
            <p class="lead">
                @auth
                <a class="btn btn-primary" href="/index">Ir a la aplicación</a>
                @else
                <a class="btn btn-primary" href="/login">Iniciar sesión</a>
                @endauth
            </p>
        </main>
        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p>Dirección de Tecnologías de la Informacíón - Ministerio de Economía</p>
            </div>
        </footer>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if(localStorage.getItem('app-name') == null) {
                localStorage.setItem('app-name', "{{config('app.name')}}");
            }
        });
    </script>
</body>
</html>