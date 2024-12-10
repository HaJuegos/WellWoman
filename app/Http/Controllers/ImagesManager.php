<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImagesManager extends Controller
{
    public static function saveImgToDB(Request $rqs)
    {
        $image = $rqs->file('image');

        $formData = [
            'key' => '1f3fb1b46ebbcc7e3f8b3795bc1a05d8',
            'image' => fopen($image->getRealPath(), 'r')
        ];

        $response = Http::withOptions(['verify' => false])->attach('image', fopen($image->getRealPath(), 'r'))->post('https://api.imgbb.com/1/upload', $formData);

        $data = $response->json();

        return $data['data']['url'];
    }
}
