<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="plantilla para inicio, reininio de sesión y registro de usuarios">
	<title>@yield('titulo')</title>
	<link href="/css/session.css" rel="stylesheet">
</head>
<body class="bg-mineco">
	@yield('contenido')
	@yield('script');
</body>
</html>