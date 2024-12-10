<?php

namespace App\Http\Controllers;

class UserData extends Controller
{
    public function index()
    {
        $pageId = "data";
        return view('userData/index', compact('pageId'));
    }
}
