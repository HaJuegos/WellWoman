<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    public function index()
    {
        return view("login/index");
    }

    public function login(Request $rqs)
    {
        $emailName = $rqs->input('useroremail');
        $password = $rqs->input('pass');

        $user = Usuario::where('email', $emailName)->orWhere('name', $emailName)->first();

        if (!$user) {
            return redirect()->back()->with('session_type', 'errorNoEmail');
        }

        if (!Hash::check($password, $user->password)) {
            return redirect()->back()->with('session_type', 'errorPass');
        }

        $user->last_session = now();
        $user->save();

        Auth::login($user, true);

        return redirect()->route("mainPage.index")->with('session_type', 'logginSuccess');
    }

    public function waitLogout()
    {
        return view('logout/index');
    }

    public function logout(Request $rqs)
    {
        $user = Auth::user();

        if ($user) {
            $user->last_session = now();
            $user->save();
        }

        $rqs->session()->invalidate();
        $rqs->session()->regenerateToken();

        Auth::logout();

        return redirect()->route('mainPage.index')->with('session_type', 'logoutSuccess');
    }
}
