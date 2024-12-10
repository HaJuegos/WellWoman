<head>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    @vite([
        // CSS
        'resources/css/main/header/index.css',
    
        // JS
        'resources/js/main/buttons.js',
    ])

    <script>
        const mainPageVar = "{{ route('mainPage.index') }}";
        const userPageVar = "{{ route('login.index') }}";
        const calendarPageVar = "{{ route('calendar.index') }}";
        const forumsPageVar = "{{ route('forum.index') }}";
        const shopPageVar = "{{ route('shop.index') }}";
        const pageID = "{{ $pageId }}";
        let myProfileVar = "";

        @if (auth()->check())
            const isLogin = true
            myProfileVar = "{{ route('profilePage', ['id' => auth()->user()->id]) }}";
        @else
            const isLogin = false
        @endif
    </script>
</head>

<body>
    {{-- Todo lo relacionado a los botones de arriba del menu --}}
    <header>
        {{-- Dialogo que aparece cuando el usuario inicia sesion correctamente. --}}
        @switch(session('session_type'))
            @case('logginSuccess')
                <x-notification-success message="Iniciaste sesion correctamente."
                    subtext="Bienvenido {{ auth()->user()->name }}" />
            @break

            @case('logoutSuccess')
                <x-notification-success message="Cerraste sesion correctamente." subtext="¡Nos vemos pronto!" />
            @break
        @endswitch

        <nav class="main_container">
            <div class="logo">
                <img src="{{ Vite::asset('resources/imgs/favicon.ico') }}" alt="ww_logo">
                <h2>WellWoman</h2>
            </div>

            <div class="buttons">
                <button id="calendar" class="button"><span
                        class="material-symbols-outlined">calendar_month</span>Calendario</button>

                <button id="forums" class="button"><span class="material-symbols-outlined"> groups
                    </span>Foros</button>

                <button id="shop" class="button"><span class="material-symbols-outlined"> shopping_cart
                    </span>Tienda</button>

                <button id="user" class="button"> <span class="material-symbols-outlined"> account_circle
                    </span>Iniciar Sesion </button>
            </div>
        </nav>
    </header>
</body>
