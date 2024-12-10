<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationSetting extends Controller
{
    public function index()
    {
        $pageId = "notification";
        return view('notificationSetting/index', compact('pageId'));
    }
}
