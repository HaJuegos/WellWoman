<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Calendars extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pageId = 'calendarPage';
        $cycleData = $user->cicloMenstrual ?? null;

        return view("calendar.index", ['pageId' => $pageId, 'cycleData' => $cycleData, 'noData' => !$cycleData, 'idUser' => $user->id ?? 0]);
    }

    public function updateData(Request $rqs)
    {
        $user = Auth::user();
        $ciclo = $user->cicloMenstrual;

        $ciclo->update([
            'lastPeriod' => $rqs->input('selected_date')
        ]);

        return redirect()->route('calendar.index')->with('dateChanged', true);
    }
}
