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
        $settings = Settings::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.settings', ['settings' => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settingsAdd');
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
            return Redirect::back()->withInput()->withErrors($validator);
        }
  
        $input = $request->all();

   
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $originalFileName = $image->getClientOriginalName(); 
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }
    
        Settings::create($input);
        return redirect()->route('settings.list')->with('success', 'Added successfully.');

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $settings = Settings::find($id);
    
        if (!$settings) {
            return redirect()->route('settings.list')->with('error', 'settings not found.');
        }
        return view('admin.settingsEdit', ['settings' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $settings = Settings::find($id);
        
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'link' => 'string|max:255',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
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
        return redirect()->route('settings.list')->with('success', 'Settings Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $settings = Settings::find($id);
        $settings->delete();
        return redirect()->route('settings.list')->with('success', 'Settings deleted successfully.');

    }
}
