<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    <title>WellWoman - Ajustes de Notificaciones</title>

    @vite([
        // CSS
        'resources/css/notificationSetting/index.css',
        'resources/css/notificationSetting/main/index.css',

        // JS
        'resources/js/notificationSetting/index.js',
    ])
</head>

<body>
    @include('main.header')
    <main>
        <h1>Configuración de Notificaciones</h1>

        <!-- Sección de preferencias -->
        <section>
            <h2>Preferencias de Notificación</h2>
            <form id="notifications-form">
                <!-- Tipo de notificaciones -->
                <fieldset>
                    <legend>Tipo de Notificaciones</legend>
                    <div class="toggle-option">
                        <span>Notificaciones por correo electrónico</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="email-notifications" checked>
                            <div class="toggle-switch-background">
                                <div class="toggle-switch-handle"></div>
                            </div>
                        </label>
                    </div>
                    <div class="toggle-option">
                        <span>Notificaciones de compras</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="sms-notifications">
                            <div class="toggle-switch-background">
                                <div class="toggle-switch-handle"></div>
                            </div>
                        </label>
                    </div>
                    <div class="toggle-option">
                        <span>Notificaciones push</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="push-notifications">
                            <div class="toggle-switch-background">
                                <div class="toggle-switch-handle"></div>
                            </div>
                        </label>
                    </div>
                </fieldset>

                <!-- Frecuencia -->
                <fieldset>
                    <legend>Frecuencia</legend>
                    <label class="Frecuencia container">
                        <input type="radio" name="frequency" value="instant" checked>
                        <div class="checkmark"></div>
                        Frecuente
                    </label>
                    <label class="Frecuencia container">
                        <input type="radio" name="frequency" value="daily">
                        <div class="checkmark"></div>
                        Poco Frecuente
                    </label>
                    <label class="Frecuencia container">
                        <input type="radio" name="frequency" value="weekly">
                        <div class="checkmark"></div>
                        Desactivadas
                    </label>
                </fieldset>


                <!-- Actividades -->
                <fieldset>
                    <legend>Actividades que Deseas Recibir</legend>
                    <div class="toggle-option">
                        <span>Nuevas publicaciones en el blog</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="new-posts" checked>
                            <div class="toggle-switch-background">
                                <div class="toggle-switch-handle"></div>
                            </div>
                        </label>
                    </div>
                    <div class="toggle-option">
                        <span>Actualizaciones de pedidos</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="order-updates" checked>
                            <div class="toggle-switch-background">
                                <div class="toggle-switch-handle"></div>
                            </div>
                        </label>
                    </div>
                    <div class="toggle-option">
                        <span>Respuestas en el foro</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="forum-replies">
                            <div class="toggle-switch-background">
                                <div class="toggle-switch-handle"></div>
                            </div>
                        </label>
                    </div>
                </fieldset>

                <!-- Botón de guardar -->
                <button class="guardar" type="submit">Guardar Configuración</button>
            </form>
        </section>
    </main>
    @include('main.footer')
</body>

</html>
