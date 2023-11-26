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
        $settings = Settings::orderBy('created_at', 'desc')->paginate(10);

        foreach ($settings as $record) {
            $imageName = $record->image;
            $imageUrl = asset('image/' . $imageName);
            $record->image = $imageUrl;
        }
        return response()->json($settings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'link' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $input=$request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $originalFileName = $image->getClientOriginalName(); 
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }
    
        Settings::create($input);
        
        return response()->json('Settings created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $settings = Settings::find($id);

        $imageName = $settings->image;
        $imageUrl = asset('image/' . $imageName);
        $settings->image = $imageUrl;
        
        return response()->json($settings);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id )
    {
        $settings = Settings::find($id);
        if (!$settings) {
            return response()->json(['error' => 'settings not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'link' => 'string|max:255',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
    
        $input = $request->all();
        
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $originalFileName = $image->getClientOriginalName(); 
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
            
            // Delete old image file if it exists
            if ($settings->image) {
                unlink(public_path($destinationPath . $settings->image));
            }
        }
    
        $settings->update($input);
        return response()->json('Settings updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $settings = Settings::find($id);
        $settings->delete();
        return response()->json('Settings deleted successfully');
    }
}
