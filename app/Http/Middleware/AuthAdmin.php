<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    public function handle(Request $rqs, Closure $next): Response
    {
        $user = Auth::user();
        $roles = $user->roles->pluck('type')->toArray();
        $id = $user->id;

        if (!in_array('Administrador', $roles)) {
            return redirect()->route('profilePage.noperms', ['id' => $id])->with('noPerms', true);
        };

        return $next($rqs);
    }
}
