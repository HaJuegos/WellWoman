<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RegisterUser extends Controller
{
    public function index()
    {
        return view("register/index");
    }

    public function store(Request $rqs)
    {
        $captchaKey = "6LczEmwqAAAAAHcKD5YOL4DWTONnMDOX-dY8tVEG";
        $username = $rqs->input('usernameinput');
        $email = $rqs->input('emailinput');
        $captcha = $rqs->input('g-recaptcha-response');

        $cResponse = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
            'secret' => $captchaKey,
            'response' => $captcha
        ]);

        $cRBody = json_decode($cResponse->getBody(), true);

        $existingUser = Usuario::where('name', $username)->first();
        $existingEmail = Usuario::where('email', $email)->first();

        if ($existingUser) {
            return redirect()->back()->with('session_type', "errNameExisting");
        } else if ($existingEmail) {
            return redirect()->back()->with('session_type', "errEmailExisting");
        };

        if (!$cRBody['success']) {
            return redirect()->back()->with('session_type', 'errCatcha');
        };

        $user = Usuario::create([
            "email" => $email,
            "password" => Hash::make($rqs->input("passinput1")),
            "name" => $username,
            "creation_date" => now(),
            "last_session" => now()
        ]);

        $rolUsuario = Rol::where('type', 'Usuario')->first();

        $user->roles()->attach($rolUsuario->id);

        return redirect()->route("login.index")->with('session_type', 'registerSuccess');
    }
}
