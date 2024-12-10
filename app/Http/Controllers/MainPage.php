<?php

namespace App\Http\Controllers;

class MainPage extends Controller
{
    public function index()
    {
        $pageId = "mainPage";
        return view('main/index', compact('pageId'));
    }
}
