<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite([
        // CSS
        'resources/css/adminUsers/index.css',
        'resources/css/adminUsers/main/index.css',

        'resources/css/adminUsers/dialogs/index.css',

        // JS
        'resources/js/adminUsers/popups.js',
        'resources/js/adminUsers/filterInput.js',
        'resources/js/adminUsers/dynamicDates.js',
    ])

    <script>
        let urlEdit = `{{ route('manageUsers.changeRol', ['id' => '0']) }}`;
        let urlDeleted = `{{ route('manageUsers.removeUser', ['id' => '0']) }}`;
    </script>

    <title>WellWoman - Administrar Usuarios</title>
</head>

<body>
    @switch(session('session_type'))
        @case('roleChanged')
            <x-notification-success message="Se ha cambiado los roles del usuario." subtext="" />
        @break

        @case('userDeleted')
            <x-notification-success message="Se elimino el usuario correctamente." subtext="No te extrañaremos" />
        @break
    @endswitch

    {{-- Esto ya exporta el header de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.header')

    <main class="manage-container">
        <section class="manage-list">

            <div class="manage-title">
                <h1>Lista de Usuarios</h1>
                <div class="manage-search">
                    <label for="filter-users">Buscar Usuarios: </label>
                    <input id="filter-users" type="text" placeholder="Introduce un nombre...">
                </div>
            </div>

            <table class="manage-table">
                <colgroup>
                    <col class="id-column">
                    <col class="user-column">
                    <col class="lastsession-column">
                    <col class="rol-column">
                    <col class="actionsbtns-column">
                </colgroup>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Último Acceso</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usersData as $user)
                        <tr>
                            <td class="id">{{ $user->id }}</td>

                            <td>
                                <div class="user-info">
                                    <div class="user-icon">
                                        <img loading="lazy" src="{{ $user->profile_url }}" alt="pfp-image">
                                    </div>

                                    <div class="user-name-info">
                                        <p class="user-name">{{ $user->name }}</p>
                                        <p class="email-user" title="{{ $user->email }}">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="date">{{ $user->last_session }}</td>

                            <td class="roles">{{ $user->roles->last()->type }}</td>

                            <td>
                                <div class="btns">
                                    <button id="editroles" class="editroles" data-user-id="{{ $user->id }}"
                                        data-user-roles="{{ json_encode($user->roles->pluck('id')->toArray()) }}">Modificar
                                        Roles</button>
                                    <button id="deluser" class="deluser" data-user-id="{{ $user->id }}">Eliminar
                                        Usuario</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </section>

        <dialog id="editpopup">
            <div class="edit-container">
                <h2>Modificar Roles</h2>

                <form id="edit-role-form" action="" method="POST">
                    @csrf

                    <input type="hidden" id="user-id" name="user_id">

                    <div class="roles-list">
                        @foreach ($roles as $role)
                            <label>
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                    {{ $role->type == 'Usuario' ? 'checked disabled' : '' }}>
                                {{ $role->type }}
                            </label>
                        @endforeach
                        <input type="hidden" name="roles[]" value="{{ $roles->firstWhere('type', 'Usuario')->id }}">
                    </div>

                    <div class="form-actions">
                        <button type="button" id="close-popup">Cancelar</button>
                        <button type="submit" id="save-changes">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </dialog>

        <dialog id="deleteduser-dialog">
            <div class="delete-container">
                <h2>Confirmar Eliminación</h2>
                <p>¿Estás seguro de que deseas eliminar a este usuario? Esta acción no se puede deshacer.</p>
                <form id="delete-user-form" action="" method="POST">
                    @csrf

                    <input type="hidden" id="delete-user-id" name="user_id">

                    <div class="form-actions">
                        <button type="button" id="cancel-delete">Cancelar</button>
                        <button type="submit" id="confirm-delete">Eliminar</button>
                    </div>
                </form>
            </div>
        </dialog>

    </main>

    {{-- Esto ya exporta el footer de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.footer')
</body>

</html>
