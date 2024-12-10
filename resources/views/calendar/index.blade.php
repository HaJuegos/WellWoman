<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite([
        // CSS
        'resources/css/calendar/index.css',
        'resources/css/calendar/main/index.css',
        'resources/css/calendar/main/full.css',
        'resources/css/calendar/main/alternative.css',

        'resources/css/calendar/dialogs/index.css',

        // JS
        'resources/js/calendar/initCalendar.js',
        'resources/js/calendar/fullCalendar.js',
        'resources/js/calendar/confirmData.js',
    ])

    <title>WellWoman - Calendario</title>

    <script>
        const cycleData = @json($cycleData);
    </script>
</head>

<body>
    {{-- Esto ya exporta el header de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.header')

    <main>
        @if (session('dateChanged'))
            <x-notification-success message="Se ha registrado el periodo correctamente." subtext="" />
        @endif

        <section class="calendar-container">
            @if ($noData ?? false)
                <div class="missing-cycle">
                    <h1>Al parecer te hace falta algo...</h1>
                    <h2>¡Aún no has configurado tu ciclo menstrual!</h2>
                    <p><a href="{{ route('profilePage.cycleSettings', ['id' => $idUser]) }}"
                            class="btn-setup-cycle">¿Quieres configurar tu
                            ciclo menstrual?</a></p>
                    <img src="https://i.ibb.co/09GrSJg/img3.webp" alt="img-alternative" />
                </div>
            @else
                <div class="calendar-header">
                    <h1 id="actual-day">placeholder</h1>

                    <button type="button" class="btn-full-calendar" id="btnFullCalendar"><span
                            class="material-symbols-outlined"> calendar_month </span></button>
                </div>

                <div class="calendar-body">
                    <div class="calendar-days-header">
                        <div>D</div>
                        <div>L</div>
                        <div>M</div>
                        <div>MI</div>
                        <div>J</div>
                        <div>V</div>
                        <div>S</div>
                    </div>

                    <div class="calendar-slider">
                        <button id="prevButton" class="calendar-nav-button">←</button>
                        <div class="calendar-days-row" id="calendarGrid"></div>
                        <button id="nextButton" class="calendar-nav-button">→</button>
                    </div>

                    <div id="actionText" class="calendar-action-text">¡Puedes usar las flechitas del teclado para mover
                        el
                        calendario tambien!</div>
                </div>

                <div class="calendar-footer">
                    <h2 id="actual-situation">placeholder uwu</h2>
                    <h4 id="restant-days">placeholder</h4>
                    <h1 id="change-text">placeholder</h1>

                    <button type="button" class="btn-add-period" id="btnAddPeriod">Registrar Periodo</button>
                </div>

                <div class="full-calendar-container" id="fullCalendar" style="display: none;">

                    <div class="full-calendar-header">
                        <button type="button" class="btn-close-calendar" id="btnCloseCalendar"><span
                                class="material-symbols-outlined">close</span> </button>
                        <h1 id="full-calendar-title">placeholder uwu</h1>
                    </div>

                    <div class="full-calendar-body">
                        <div class="full-calendar-grid">
                        </div>
                    </div>
                </div>

                <dialog id="notificationModal" class="notification-modal">
                    <form method="POST" action="{{ route('calendar.changeData') }}" id="confirmPeriodForm">
                        @csrf

                        <p id="notificationMessage">¿Estás segura de registrar tu periodo en este día?</p>

                        <input type="hidden" name="selected_date" id="selectedDateInput">

                        <div class="notification-actions">
                            <button type="submit" class="btn-confirm">Aceptar</button>
                            <button type="button" class="btn-cancel" id="cancelPeriodButton">Cancelar</button>
                        </div>
                    </form>
                </dialog>
            @endif
        </section>
    </main>

    @include('main.footer')
</body>

</html>
