<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class SettingsController extends Controller
{
    
    public function index()
    {
        $settings = Settings::first();
        return view('admin.settings', ['settings' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'radio_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'tv_en_vivo_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'youtube_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'facebook_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'instagram_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'books_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'books_sharp_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'web_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'phone_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'donate_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $id = $request->id;

        $settings = Settings::find($id);
        if (!$settings) {
            return redirect()->route('settings.list')->with('error', 'Settings not found.');
        }

        $radio = $request->radio ?? $settings->radio;
        $radio_link = $request->radio_link ?? $settings->radio_link;
        $radio_image = $settings->radio_image;
        $tv_en_vivo = $request->tv_en_vivo ?? $settings->tv_en_vivo;
        $tv_en_vivo_link = $request->tv_en_vivo_link ?? $settings->tv_en_vivo_link;
        $tv_en_vivo_image = $settings->tv_en_vivo_image;
        $youtube = $request->youtube ?? $settings->youtube;
        $youtube_link = $request->youtube_link ?? $settings->youtube_link;
        $youtube_image = $settings->youtube_image;
        $facebook = $request->facebook ?? $settings->facebook;
        $facebook_link = $request->facebook_link ?? $settings->facebook_link;
        $facebook_image = $settings->facebook_image;
        $instagram = $request->instagram ?? $settings->instagram;
        $instagram_link = $request->instagram_link ?? $settings->instagram_link;
        $instagram_image = $settings->instagram_image;
        $books = $request->books ?? $settings->books;
        $books_link = $request->books_link ?? $settings->books_link;
        $books_image = $settings->books_image;
        $books_sharp = $request->books_sharp ?? $settings->books_sharp;
        $books_sharp_link = $request->books_sharp_link ?? $settings->books_sharp_link;
        $books_sharp_image = $settings->books_sharp_image;
        $web = $request->web ?? $settings->web;
        $web_link = $request->web_link ?? $settings->web_link;
        $web_image = $settings->web_image;
        $phone = $request->phone ?? $settings->phone;
        $phone_link = $request->phone_link ?? $settings->phone_link;
        $phone_image = $settings->phone_image;
        $donate = $request->donate ?? $settings->donate;
        $donate_link = $request->donate_link ?? $settings->donate_link;
        $donate_image = $settings->donate_image;
        
        if ($request->file('radio_image') && $request->file('radio_image') !== null) {
            $radio_image = $request->file('radio_image');
            $destinationPath = 'image/';
            $originalFileName = $radio_image->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $radio_image->move($destinationPath, $profileImage);
            if ($settings->radio_image && file_exists(public_path($destinationPath . $settings->radio_image))) {
                unlink(public_path($destinationPath . $settings->radio_image));
            }
            $radio_image = $profileImage;
        }
        if ($request->file('tv_en_vivo_image') && $request->file('tv_en_vivo_image') !== null) {
            $tv_en_vivo_image = $request->file('tv_en_vivo_image');
            $destinationPath = 'image/';
            $originalFileName = $tv_en_vivo_image->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $tv_en_vivo_image->move($destinationPath, $profileImage);
            if ($settings->tv_en_vivo_image && file_exists(public_path($destinationPath . $settings->tv_en_vivo_image))) {
                unlink(public_path($destinationPath . $settings->tv_en_vivo_image));
            }
            $tv_en_vivo_image = $profileImage;
        }
        if ($request->file('youtube_image') && $request->file('youtube_image') !== null) {
            $youtube_image = $request->file('youtube_image');
            $destinationPath = 'image/';
            $originalFileName = $youtube_image->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $youtube_image->move($destinationPath, $profileImage);
            if ($settings->youtube_image && file_exists(public_path($destinationPath . $settings->youtube_image))) {
                unlink(public_path($destinationPath . $settings->youtube_image));
            }
            $youtube_image = $profileImage;
        }
        if ($request->file('facebook_image') && $request->file('facebook_image') !== null) {
            $facebook_image = $request->file('facebook_image');
            $destinationPath = 'image/';
            $originalFileName = $facebook_image->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $facebook_image->move($destinationPath, $profileImage);
            if ($settings->facebook_image && file_exists(public_path($destinationPath . $settings->facebook_image))) {
                unlink(public_path($destinationPath . $settings->facebook_image));
            }
            $facebook_image = $profileImage;
        }
        if ($request->file('instagram_image') && $request->file('instagram_image') !== null) {
            $instagram_image = $request->file('instagram_image');
            $destinationPath = 'image/';
            $originalFileName = $instagram_image->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $instagram_image->move($destinationPath, $profileImage);
            if ($settings->instagram_image && file_exists(public_path($destinationPath . $settings->instagram_image))) {
                unlink(public_path($destinationPath . $settings->instagram_image));
            }
            $instagram_image = $profileImage;
        }
        if ($request->file('books_image') && $request->file('books_image') !== null) {
            $books_image = $request->file('books_image');
            $destinationPath = 'image/';
            $originalFileName = $books_image->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $books_image->move($destinationPath, $profileImage);
            if ($settings->books_image && file_exists(public_path($destinationPath . $settings->books_image))) {
                unlink(public_path($destinationPath . $settings->books_image));
            }
            $books_image = $profileImage;
        }
        if ($request->file('books_sharp_image') && $request->file('books_sharp_image') !== null) {
            $books_sharp_image = $request->file('books_sharp_image');
            $destinationPath = 'image/';
            $originalFileName = $books_sharp_image->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $books_sharp_image->move($destinationPath, $profileImage);
            if ($settings->books_sharp_image && file_exists(public_path($destinationPath . $settings->books_sharp_image))) {
                unlink(public_path($destinationPath . $settings->books_sharp_image));
            }
            $books_sharp_image = $profileImage;
        }
        if ($request->file('web_image') && $request->file('web_image') !== null) {
            $web_image = $request->file('web_image');
            $destinationPath = 'image/';
            $originalFileName = $web_image->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $web_image->move($destinationPath, $profileImage);
            if ($settings->web_image && file_exists(public_path($destinationPath . $settings->web_image))) {
                unlink(public_path($destinationPath . $settings->web_image));
            }
            $web_image = $profileImage;
        }
        if ($request->file('phone_image') && $request->file('phone_image') !== null) {
            $phone_image = $request->file('phone_image');
            $destinationPath = 'image/';
            $originalFileName = $phone_image->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $phone_image->move($destinationPath, $profileImage);
            if ($settings->phone_image && file_exists(public_path($destinationPath . $settings->phone_image))) {
                unlink(public_path($destinationPath . $settings->phone_image));
            }
            $phone_image = $profileImage;
        }
        if ($request->file('donate_image') && $request->file('donate_image') !== null) {
            $donate_image = $request->file('donate_image');
            $destinationPath = 'image/';
            $originalFileName = $donate_image->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $donate_image->move($destinationPath, $profileImage);
            if ($settings->donate_image && file_exists(public_path($destinationPath . $settings->donate_image))) {
                unlink(public_path($destinationPath . $settings->donate_image));
            }
            $donate_image = $profileImage;
        }
      

        try {
            $settings->radio = $radio    ;
            $settings->radio_link = $radio_link    ;
            $settings->radio_image = $radio_image    ;
            $settings->tv_en_vivo = $tv_en_vivo    ;
            $settings->tv_en_vivo_link = $tv_en_vivo_link    ;
            $settings->tv_en_vivo_image = $tv_en_vivo_image    ;
            $settings->youtube = $youtube    ;
            $settings->youtube_link = $youtube_link    ;
            $settings->youtube_image = $youtube_image    ;
            $settings->facebook = $facebook    ;
            $settings->facebook_link = $facebook_link    ;
            $settings->facebook_image = $facebook_image    ;
            $settings->instagram = $instagram    ;
            $settings->instagram_link = $instagram_link    ;
            $settings->instagram_image = $instagram_image    ;
            $settings->books = $books    ;
            $settings->books_link = $books_link    ;
            $settings->books_image = $books_image    ;
            $settings->books_sharp = $books_sharp    ;
            $settings->books_sharp_link = $books_sharp_link    ;
            $settings->books_sharp_image = $books_sharp_image    ;
            $settings->web = $web    ;
            $settings->web_link = $web_link    ;
            $settings->web_image = $web_image    ;
            $settings->phone = $phone    ;
            $settings->phone_link = $phone_link    ;
            $settings->phone_image = $phone_image    ;
            $settings->donate = $donate    ;
            $settings->donate_link = $donate_link    ;
            $settings->donate_image = $donate_image    ;
            $settings->save();
            return redirect()->route('settings.list')->with('success', 'Settings Updated successfully.');

        } catch (\Exception $e) {
            return redirect()->route('settings.list')->with('error', 'Error updating settings: ' . $e->getMessage());
        }
    }

    
    
}
