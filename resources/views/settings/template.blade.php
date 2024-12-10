<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite([
        // CSS
        'resources/css/settings/index.css',
    ])

    <title>@yield('title', 'WellWoman - Configuracion')</title>
</head>

<body>
    {{-- Esto ya exporta el header de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.header')

    <main>
        {{-- Cambio dinamico para todos los contenidos de configuracion --}}
        @yield('content')
    </main>

    {{-- Esto ya exporta el footer de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.footer')
</body>

</html>
