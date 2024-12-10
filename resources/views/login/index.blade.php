<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite([
        // CSS
        'resources/css/login/index.css',

        'resources/css/login/main/index.css',
        'resources/css/login/roses/index.css',

        // JS
        'resources/js/login/rosesAnimation.js',
        'resources/js/login/remember.js',
        'resources/js/passView.js',
    ])

    <title>WellWoman - Iniciar Sesion</title>
</head>

<body>
    @switch(session('session_type'))
        @case('registerSuccess')
            <x-notification-success message="Te has registrado correctamente." subtext="¡Bienvenido a WellWoman!" />
        @break

        @case('errorNoEmail')
            <x-notification-error message="El usuario no esta registrado." subtext="Prueba a intentar registrarte." />
        @break

        @case('errorPass')
            <x-notification-error message="Correo o contraseña incorrectos." subtext="¿Era 123456789?" />
        @break
    @endswitch

    <div class="containerRosa">
        <img src="https://i.ibb.co/k3BK95k/rose.webp" alt="Rosa" class="rosa">
        <img src="https://i.ibb.co/k3BK95k/rose.webp" alt="Rosa" class="rosa">
        <img src="https://i.ibb.co/k3BK95k/rose.webp" alt="Rosa" class="rosa">
        <img src="https://i.ibb.co/k3BK95k/rose.webp" alt="Rosa" class="rosa">
        <img src="https://i.ibb.co/k3BK95k/rose.webp" alt="Rosa" class="rosa">
        <img src="https://i.ibb.co/k3BK95k/rose.webp" alt="Rosa" class="rosa">
        <img src="https://i.ibb.co/k3BK95k/rose.webp" alt="Rosa" class="rosa">
        <img src="https://i.ibb.co/k3BK95k/rose.webp" alt="Rosa" class="rosa">
        <img src="https://i.ibb.co/k3BK95k/rose.webp" alt="Rosa" class="rosa">
    </div>

    <main>
        <div class="login-container">
            <p>Iniciar Sesion</p>

            <form action="{{ route('login.getData') }}" method="post" autocomplete="on">
                @csrf {{-- Siempre añadir esto a los forms para que funcionen. --}}

                <div class="inputs">
                    <div class="input">
                        <input type="text" name="useroremail" id="nameinput" placeholder="Nombre de Usuario o Correo"
                            autofocus required>
                        <div class="login-icon iconuser">
                            <span class="material-symbols-outlined">person </span>
                        </div>
                    </div>

                    <div class="input">
                        <input type="password" name="pass" id="passinput" placeholder="Contraseña" autofocus
                            required>

                        <div class="login-icon iconspass">
                            <span class="viewPassLogin clickeable material-symbols-outlined">lock</span>
                        </div>
                    </div>

                    <div class="remember-container checkbox-wrapper-3">
                        <div class="button">
                            <input type="checkbox" id="cbx-3" />
                            <label for="cbx-3" class="toggle"><span></span></label>
                        </div>

                        <div class="button-msg">
                            <label>¿Recordar cuenta?</label>
                        </div>

                        <div class="passlink">
                            <a href="recoverpass">¿Olvidaste tu contraseña?</a>
                        </div>
                    </div>

                    <input type="submit" value="Entrar">
                </div>
            </form>

            <div class="register-container">
                <a href="{{ route('register.index') }}">¿Aun no te has registrado?</a>
                <a href="{{ route('register.index') }}">Registrate ahora mismo</a>
            </div>
        </div>
    </main>
</body>

</html>
