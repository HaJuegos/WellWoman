<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    @vite([
        // CSS
        'resources/css/register/index.css',
        'resources/css/register/main/index.css',
        'resources/css/register/starts/index.css',
        'resources/css/register/starts/index.css',

        // JS
        'resources/js/passView.js',
        'resources/js/register/passSecurity.js',
        'resources/js/register/checkInputs.js',
    ])

    <title>WellWoman - Registrarse</title>
</head>

<body>
    <main>
        @switch(session('session_type'))
            @case('errNameExisting')
                <x-notification-error message="El nombre de usuario ya existe." subtext="¿Que haces? Inicia sesion mejor." />
            @break

            @case('errEmailExisting')
                <x-notification-error message="El correo ya existe" subtext="No puedes hacer 2 cuentas con el mismo correo." />
            @break

            @case('errCatcha')
                <x-notification-error message="Debes hacer el Recaptcha" subtext="Beep boop beep. ¡Eres un robot!" />
            @break
        @endswitch

        <div class="container-estrellas">
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
        </div>

        <div class="register-container">
            <p>Registrarse</p>

            <form action="{{ route('register.getData') }}" method="post" id="formregister">
                @csrf

                <div class="inputs">
                    <div class="input">
                        <div id="error-email" class="error-arg hidden">
                            <span>Los correos electronicos deben ser iguales.</span>
                        </div>
                        <input type="email" name="emailinput" id="emailinput"
                            placeholder="Introducce tu Correo Electronico" autofocus required>
                        <div class="register-icon iconmail1">
                            <span class="material-symbols-outlined">mail </span>
                        </div>
                    </div>

                    <div class="input">
                        <div id="error-email" class="error-arg hidden">
                            <span>Los correos electronicos deben ser iguales.</span>
                        </div>
                        <input type="email" name="emailinputrepeat" id="emailinputrepeat"
                            placeholder="Repite tu Correo Electronico" autofocus required>
                        <div class="register-icon iconmai2">
                            <span class="material-symbols-outlined">mail </span>
                        </div>
                    </div>

                    <div class="input">
                        <div id="error-pass" class="error-arg hidden">
                            <span>Las contraseñas no son iguales.</span>
                        </div>
                        <input type="password" name="passinput1" id="passinputregister1"
                            placeholder="Ingresa tu Contraseña" autofocus required>
                        <div class="register-icon iconspass1">
                            <span id="viewPassRegister1" class="clickeable material-symbols-outlined">lock </span>
                        </div>
                    </div>

                    <div class="security-container" id="securitycheck">
                        <p>Nivel de seguridad:</p>
                        <div class="security-images">
                            <img src="https://i.ibb.co/mDtKN3H/var-1.webp" alt="Barra de Seguridad 1" id="secuimg1"
                                class="hidden">
                            <img src="https://i.ibb.co/wpJ2qgs/var-2.webp" alt="Barra de Seguridad 2" id="secuimg2"
                                class="hidden">
                            <img src="https://i.ibb.co/y6KFf1F/var-3.webp" alt="Barra de Seguridad 3" id="secuimg3"
                                class="hidden">
                        </div>
                    </div>

                    <div class="input">
                        <div id="error-pass-repeat" class="error-arg hidden">
                            <span>Las contraseñas no son iguales.</span>
                        </div>
                        <input type="password" name="passinput2" id="passinputregister2"
                            placeholder="Repite tu Contraseña" autofocus required>
                        <div class="register-icon iconspass2">
                            <span id="viewPassRegister2" class="clickeable material-symbols-outlined">lock </span>
                        </div>
                    </div>

                    <div class="input">
                        <input type="text" name="usernameinput" id="usernameinput"
                            placeholder="Nombre de Usuario (Opcional)" autofocus>
                        <div class="register-icon iconuser">
                            <span class="material-symbols-outlined">person </span>
                        </div>
                    </div>

                    <div class="g-recaptcha" data-sitekey="6LczEmwqAAAAAN1khiMn8bDWzrFZ81hoeZxmAAth"></div>

                    <div class="input">
                        <input type="submit" value="Registrarse">
                    </div>
                </div>
            </form>

            <div class="register-info">
                <div class="redirect">
                    <p>¿Ya tienes una cuenta? <a href="{{ route('login.index') }}">Inicia Sesion</a></p>
                </div>

                <p>Al registrarte, aceptas los Términos de servicio y la Política de privacidad, incluida la política de
                    Uso de Cookies.</p>
            </div>
        </div>
    </main>
</body>

</html>
