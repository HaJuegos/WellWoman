@extends('settings.template')

@section('title', 'WellWoman - Configuración del Ciclo Menstrual')

@section('content')
    @vite([
        // CSS
        'resources/css/settings/cycle/index.css',
        'resources/css/settings/cycle/checkbox.css',

        // JS
        'resources/js/settings/cycle/updateDB.js',
    ])

    <script>
        const cycleData = @json($cycleData);
    </script>

    <section id="notification-container" class="hidden">
        <x-notification-success message="Configuracion Guardada correctamente." subtext="" />
    </section>

    <section class="config-container">
        <h1>Configuración del Ciclo Menstrual</h1>

        <div class="form-container">
            <form action="{{ route('cycleSettings.update', ['id' => $id]) }}" method="POST">
                @csrf

                {!! $cycleOptionsHtml !!}

                <input type="submit" style="display:none;">
            </form>
        </div>
    </section>
@endsection
