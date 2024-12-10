<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite([
        // CSS
        'resources/css/profile/index.css',
        'resources/css/profile/main/index.css',

        // JS
        'resources/js/profile/btns.js',
        'resources/js/profile/cycleBtns.js',
        'resources/js/profile/database.js',
    ])

    <script>
        const rol = @json($rolesData);
        const logoutVar = "{{ route('profilePage.logout') }}";
        const manageUsersVar = "{{ route('manageUsers.index') }}";
        const settingsVar = "{{ route('profilePage.cycleSettings', ['id' => $userData->id]) }}";
        const privacyVar = "{{ route('privacy.index') }}";
        const notiVar = "{{ route('notification.index') }}";
        const dataVar = "{{ route('userData.index') }}";
        const helpVar = "https://www.termsfeed.com/live/03225f55-8472-4692-9f0f-ddcae1d0a2bd";
    </script>

    <title>WellWoman - Perfil de {{ $userData->name }}</title>
</head>

<body>
    {{-- Esto ya exporta el header de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.header')

    @if (session('noPerms'))
        <x-notification-error message="No tienes permisos para realizar esta accion." subtext="¿Que intentas hacer?" />
    @elseif (session('noFindUser'))
        <x-notification-error message="No existe un usuario con ese ID que has introduccido."
            subtext="Verifica la base de datos" />
    @elseif (session('changeImg'))
        <x-notification-success message="Se ha cambiado la foto de perfil correctamente." subtext="Bonita foto, ¿eh?" />
    @endif

    <main class="profile-page">
        <section class="profile-container">

            <div class="profile-header">

                <div class="profile-image">
                    <form id="imageForm" action="{{ route('profilePage.newImage', ['id' => $userData->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <input class="nonevisible" type="file" accept="image/*" id="fileInput" name="image"
                            required>

                        <div class="profile-img-container">
                            <img src="{{ $userData->profile_url }}" alt="profile_image" id="profilePic">
                        </div>

                        <div class="camera-icon">
                            <span class="material-symbols-outlined"> add_a_photo</span>
                        </div>

                    </form>
                </div>

                <div class="profile-texts">
                    <div class="profile-name-items">
                        <h1 class="profile-name">{{ $userData->name }}</h1>
                        <div class="badges">
                            <span class="material-symbols-outlined" data-role="Usuari@">person</span>
                            <span class="material-symbols-outlined" data-role="Administrador(a)"
                                id="badgeAdmin">shield_person</span>
                            <span class="material-symbols-outlined" data-role="Vendedor(a)"
                                id="badgeVendor">server_person</span>
                        </div>
                    </div>
                    <p class="profile-email">{{ $userData->email }}</p>
                </div>
            </div>

            <div class="profile-btns">
                <h2>Mi Ciclo:</h2>
                <div class="checkbox-group">
                    <label class="checkbox-btn">
                        <input type="checkbox" name="followCycle" id="btnCycle">
                        <span>Seguir mi periodo</span>
                    </label>

                    <label class="checkbox-btn">
                        <input type="checkbox" name="followPregnant" id="btnPregnant1">
                        <span>Quedarme embarazada</span>
                    </label>

                    <label class="checkbox-btn">
                        <input type="checkbox" name="followPregnantQuery" id="btnPregnant2">
                        <span>Seguir mi embarazo</span>
                    </label>
                </div>
            </div>

            <div class="profile-actions">
                <button class="profile-button" id="adminUsetsBtn"><span class="material-symbols-outlined">
                        supervisor_account </span>Administrar Usuarios </button>

                <button class="profile-button" id="infoBtn"><span
                        class="material-symbols-outlined">person_pin</span>Datos de la cuenta</button>

                <button class="profile-button" id="cycleBtn"><span
                        class="material-symbols-outlined">health_and_safety</span>Ciclo y ovulacion</button>

                <button class="profile-button" id="privacityBtn"><span
                        class="material-symbols-outlined">encrypted</span>Ajustes de privacidad</button>

                <button class="profile-button" id="rememberBtn"><span
                        class="material-symbols-outlined">notifications</span>Notificaciones</button>

                <button class="profile-button" id="helpmeBtn"><span
                        class="material-symbols-outlined">help</span>Ayuda</button>

                <button class="profile-button logout" id="logoutBtn"><span
                        class="material-symbols-outlined">logout</span>Cerrar Sesion</button>
            </div>
        </section>
    </main>

    {{-- Esto ya exporta el footer de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.footer')
</body>

</html>
