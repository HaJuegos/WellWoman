<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite(['resources/css/logout/index.css', 'resources/css/logout/main/index.css'])

    <title>WellWoman - Cerrando Sesión</title>
</head>

<body>
    <div class="contenedor">
        <div class="spinner"></div>
        <div class="mensaje">
            Cerrando sesión<span class="puntos"></span>
        </div>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = "{{ route('profilePage.logout') }}";
        }, 2000);
    </script>
</body>

</html>
