<?php

namespace App\Http\Middleware;

use App\Models\Usuario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthUser
{
    public function handle(Request $rqs, Closure $next): Response
    {
        $userInput = $rqs->route('id');
        $user = Auth::user();

        if (!$user) {
            return redirect()->route("login.index");
        } else if (!$userInput) {
            return $next($rqs);
        };

        $findUser = Usuario::find($userInput) ?? null;
        $roles = $user->roles->pluck('type')->toArray();
        $id = $user->id;

        if ($userInput != $id && !in_array('Administrador', $roles)) {
            return redirect()->route('profilePage.noperms', ['id' => $id])->with('noPerms', true);
        } else if (!$findUser && in_array('Administrador', $roles)) {
            return redirect()->route('profilePage.noperms', ['id' => $id])->with('noFindUser', true);
        };

        return $next($rqs);
    }
}
