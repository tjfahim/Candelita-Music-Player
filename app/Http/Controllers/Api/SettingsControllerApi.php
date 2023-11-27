<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Settings::first();
            $radio_image = $settings->radio_image;
            $radio_image = asset('image/' . $radio_image);
            $settings->radio_image = $radio_image;
            $tv_en_vivo_image = $settings->tv_en_vivo_image;
            $tv_en_vivo_image = asset('image/' . $tv_en_vivo_image);
            $settings->tv_en_vivo_image = $tv_en_vivo_image;
            $youtube_image = $settings->youtube_image;
            $youtube_image = asset('image/' . $youtube_image);
            $settings->youtube_image = $youtube_image;
            $facebook_image = $settings->facebook_image;
            $facebook_image = asset('image/' . $facebook_image);
            $settings->facebook_image = $facebook_image;
            $instagram_image = $settings->instagram_image;
            $instagram_image = asset('image/' . $instagram_image);
            $settings->instagram_image = $instagram_image;
            $books_image = $settings->books_image;
            $books_image = asset('image/' . $books_image);
            $settings->books_image = $books_image;
            $books_sharp_image = $settings->books_sharp_image;
            $books_sharp_image = asset('image/' . $books_sharp_image);
            $settings->books_sharp_image = $books_sharp_image;
            $web_image = $settings->web_image;
            $web_image = asset('image/' . $web_image);
            $settings->web_image = $web_image;
            $phone_image = $settings->phone_image;
            $phone_image = asset('image/' . $phone_image);
            $settings->phone_image = $phone_image;
            $donate_image = $settings->donate_image;
            $donate_image = asset('image/' . $donate_image);
            $settings->donate_image = $donate_image;
         
        return response()->json($responseData);
    }

 
}
