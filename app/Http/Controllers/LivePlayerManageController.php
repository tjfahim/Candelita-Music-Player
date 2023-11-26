<?php

namespace App\Http\Controllers;

use App\Models\LivePlayerManage;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;

class LivePlayerManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $livePlayerManageRecords = LivePlayerManage::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.music', ['livePlayerManageRecords' => $livePlayerManageRecords]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.musicAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'song_file' => 'required|file|mimes:mp3|max:20480',
            'listening' => 'integer|max:255',
            'android' => 'integer|max:255',
            'ios' => 'integer|max:255',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
  
        $input = $request->all();

        $input['listening'] = 0;
        $input['android'] = 0;
        $input['ios'] = 0;

   
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $originalFileName = $image->getClientOriginalName(); 
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }
        if ($song_file = $request->file('song_file')) {
            $destinationPath = 'song_file/';
            $originalFileName = $song_file->getClientOriginalName(); 
            $song_fileFileName = date('YmdHis') . "_" . $originalFileName; 
            $song_file->move($destinationPath, $song_fileFileName);
            $input['song_file'] = $song_fileFileName;
        }
        
    
        LivePlayerManage::create($input);
        return redirect()->route('music.list')->with('success', 'Music Added successfully.');

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $music = LivePlayerManage::find($id);
    
        if (!$music) {
            return redirect()->route('music.list')->with('error', 'Music not found.');
        }
        return view('admin.musicEdit', ['music' => $music]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $music = LivePlayerManage::find($id);
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'song_file' => 'file|mimes:mp3|max:20480',
            'listening' => 'integer|max:255',
            'android' => 'integer|max:255',
            'ios' => 'integer|max:255',
        ]);
    
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $input = $request->all();

        $input['listening'] = $input['listening'] ?? $music->listening;
        $input['android'] = $input['android'] ?? $music->android;
        $input['ios'] = $input['ios'] ?? $music->ios;
        
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $originalFileName = $image->getClientOriginalName(); 
            $profileImage = date('YmdHis') . "_" . $originalFileName;
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
            
            // Delete old image file if it exists
            if ($music->image) {
                unlink(public_path($destinationPath . $music->image));
            }
        }
    
        if ($song_file = $request->file('song_file')) {
            $destinationPath = 'song_file/';
            $originalFileName = $song_file->getClientOriginalName(); 
            $song_fileFileName = date('YmdHis') . "_" . $originalFileName; 
            $song_file->move($destinationPath, $song_fileFileName);
            $input['song_file'] = $song_fileFileName;
            
            // Delete old music file if it exists
            if ($music->song_file) {
                unlink(public_path($destinationPath . $music->song_file));
            }
        }
    
        $music->update($input);
        return redirect()->route('music.list')->with('success', 'Music Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $music = LivePlayerManage::find($id);
        $music->delete();
        return redirect()->route('music.list')->with('success', 'Music deleted successfully.');

    }
}
