<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    <title>WellWoman - Datos de la Cuenta</title>

    @vite([
        // CSS
        'resources/css/userData/index.css',
        'resources/css/userData/main/index.css',

        // JS
        'resources/js/userData/index.js',
    ])
</head>

<body>
    @include('main.header')
    <main>

        <div class="datos">
            <h1 class="tituloUno">Datos de Usuario</h1>
            <section class="secDatos">
                <h2 class="tituloDos">Información Personal</h2>
                <form id="personal-info-form">
                    <label>
                        Nombre:
                        <input type="text" id="name" placeholder="Nombre" required>
                    </label>
                    <label>
                        Correo Electrónico:
                        <input type="email" id="email" placeholder="TuNombre@example.com" required>
                    </label>
                    <label>
                        Teléfono:
                        <input type="tel" id="phone" placeholder="3332255555">
                    </label>
                    <button class="buttonD" type="submit">Actualizar Información</button>
                </form>
            </section>

            <section class="secDatos">
                <h2>Configuración de Perfil</h2>
                <form id="profile-settings-form">
                    <label>
                        <input type="checkbox" id="newsletter" checked>
                        Suscribirse al boletín informativo
                    </label>
                    <label>
                        <input type="checkbox" id="public-profile">
                        Hacer mi perfil público
                    </label>
                    <button class="buttonD" type="submit">Guardar Configuración</button>
                </form>
            </section>
        </div>

    </main>
    @include('main.footer')
</body>

</html>
