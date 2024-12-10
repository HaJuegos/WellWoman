<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite([
        // CSS
        'resources/css/errors/index.css',
        'resources/css/errors/main/index.css',

        // JS
        'resources/js/errors/randomStuff.js',
    ])

    <title>WellWoman - @yield('title')?</title>
</head>

{{-- Mensaje: @yield('message'), Codigo: @yield('code'), Titulo: @yield('title') --}}

<body>
    <main>
        <div class="err-code">
            <label>@yield('code')</label>
        </div>

        <div class="err-message">
            <label> @yield('message')</label>
        </div>

        <div class="random-msg">
            <label> placeholder </label>
        </div>

        <div class="gatillos-container">
            <img id="gatillo1" class="gatillo hidden" src="https://i.ibb.co/WP6rHTD/img1.webp" alt="gatitov1">
            <img class="gatillo hidden" src="https://i.ibb.co/gjdPjVh/img2.webp" alt="gatitov2">
            <img class="gatillo hidden" src="https://i.ibb.co/09GrSJg/img3.webp" alt="gatitov3">
        </div>
    </main>
</body>

</html>
