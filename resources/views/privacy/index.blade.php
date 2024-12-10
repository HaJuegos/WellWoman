<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    <title>WellWoman - Ajustes de Privacidad</title>

    @vite([
        // CSS
        'resources/css/privacy/index.css',
        'resources/css/privacy/main/index.css',

        // JS
        'resources/js/privacy/index.js',
    ])
</head>

<body>
    @include('main.header')
    <main>
        <div class="privacy">
            <h1>Ajustes de Privacidad</h1>
            <section class="optionPrivacy">
                <h2>Control de Cookies</h2>
                <label>
                    <input type="checkbox" id="cookies-functional" checked />
                    Permitir cookies funcionales
                </label>
                <label>
                    <input type="checkbox" id="cookies-analytics" />
                    Permitir cookies de análisis
                </label>
                <label>
                    <input type="checkbox" id="cookies-marketing" />
                    Permitir cookies de marketing
                </label>
            </section>
            <section class="optionPrivacy">
                <h2>Visibilidad del Perfil</h2>
                <label>
                    <input type="radio" name="visibility" value="public" checked />
                    Público
                </label>
                <label>
                    <input type="radio" name="visibility" value="private" />
                    Privado
                </label>
            </section>
            <section class="optionPrivacy">
                <h2>Notificaciones</h2>
                <label>
                    <input type="checkbox" id="email-notifications" checked />
                    Recibir notificaciones por correo electrónico
                </label>
                <label>
                    <input type="checkbox" id="push-notifications" />
                    Recibir notificaciones push
                </label>
            </section>
            <section class="optionPrivacy">
                <h2>Datos Compartidos</h2>
                <label>
                    <input type="checkbox" id="share-activity" />
                    Compartir actividad en redes sociales
                </label>
                <label>
                    <input type="checkbox" id="share-purchases" />
                    Compartir historial de compras para recomendaciones
                </label>
            </section>
            <button class="btonPriv" id="save-button">Guardar Cambios</button>

        </div>



    </main>
    @include('main.footer')
</body>

</html>
