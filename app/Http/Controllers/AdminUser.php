<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminUser extends Controller
{
    public function index()
    {
        $pageId = 'AdminPage';
        $users = Usuario::with('roles')->orderBy('id', 'asc')->get();
        $roles = Rol::all();

        return view('adminUsers.index', ['pageId' => $pageId, 'usersData' => $users, 'roles' => $roles]);
    }

    public function changeRole($id, Request $rqs)
    {
        $user = Usuario::findOrFail($id);

        $user->roles()->sync($rqs->input('roles', []));

        return redirect()->route('manageUsers.index')->with('session_type', 'roleChanged');
    }

    public function removeUser($id)
    {
        $user = Usuario::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('manageUsers.index')->with('session_type', 'userDeleted');
    }
}
