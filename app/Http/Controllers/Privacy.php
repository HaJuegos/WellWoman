<?php

namespace App\Http\Controllers;

class Privacy extends Controller
{
    public function index()
    {
        $pageId = "privacy";
        return view('privacy/index', compact('pageId'));
    }
}
