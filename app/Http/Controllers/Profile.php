<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Profile extends Controller
{
    public function index($id)
    {
        $pageId = "profilePage";

        $user = Usuario::find($id);
        $roles = $user->roles->pluck('type')->toArray();

        return view("profile.index", ['userData' => $user, 'rolesData' => $roles, 'pageId' => $pageId]);
    }

    public function redirect()
    {
        $id = Auth::id();
        $pageId = "profilePage";

        return redirect()->route('profilePage', ['id' => $id, 'pageId' => $pageId]);
    }

    public function newImage(Request $rqs, $id)
    {
        $user = Usuario::find($id);

        $imagePath = null;

        if ($rqs->hasFile('image')) {
            $imagePath = ImagesManager::saveImgToDB($rqs);
        }

        $user->profile_url = $imagePath;

        $user->save();

        return redirect()->route('profilePage', ['id' => $id])->with('changeImg', true);
    }

    public function cycleSettings($id)
    {
        $pageId = 'settingsPage';
        $user = Auth::user();
        $cycleData = $user->cicloMenstrual ?? null;

        return view('settings.cycle', ['pageId' => $pageId, 'id' => $id, 'cycleData' => $cycleData]);
    }

    public function changeCicle(Request $rqs, string $id)
    {
        $user = Usuario::findOrFail($id);

        $data = $rqs->all();

        $updateData = [];

        foreach ($data as $key => $value) {
            if ($value != '-1') {
                if ($key == 'lastPeriod') {
                    $updateData[$key] = date('Y-m-d', strtotime($value));
                } else {
                    $updateData[$key] = is_numeric($value) ? (int) $value : $value;
                }
            }
        }

        if (!empty($updateData)) {
            $user->cicloMenstrual()->updateOrCreate(
                ['user_id' => $user->id],
                $updateData
            );

            return response()->json(['success' => true, 'message' => 'Configuración guardada correctamente.']);
        }
    }
}
