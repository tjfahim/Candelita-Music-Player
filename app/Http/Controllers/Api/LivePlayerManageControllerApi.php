<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LivePlayerManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LivePlayerManageControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livePlayerManageRecords = LivePlayerManage::orderBy('created_at', 'desc')->paginate(10);

        foreach ($livePlayerManageRecords as $record) {
            $imageName = $record->image;
            $imageUrl = asset('image/' . $imageName);
            $record->image = $imageUrl;
    
            $songFileName = $record->song_file;
            $songFileUrl = asset('song_file/' . $songFileName);
            $record->song_file = $songFileUrl;
        }

        return response()->json($livePlayerManageRecords);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            return response()->json(['errors' => $validator->errors()], 422);
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
        
        return response()->json('Music created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $music = LivePlayerManage::find($id);
        $imageName = $music->image;
        $imageUrl = asset('image/' . $imageName);
        $music->image = $imageUrl;

        $song_fileName = $music->song_file;
        $song_fileUrl = asset('song_file/' . $song_fileName);
        $music->song_file = $song_fileUrl;


        return response()->json($music);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LivePlayerManage $livePlayerManage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $music = LivePlayerManage::find($id);
        if (!$music) {
            return response()->json(['error' => 'Music not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'artist' => 'string|max:255',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'song_file' => 'file|mimes:mp3|max:20480',
            'listening' => 'integer|max:255',
            'android' => 'integer|max:255',
            'ios' => 'integer|max:255',
        ]);
    
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
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
        return response()->json('Music updated successfully');
    }
    public function updatelistening(Request $request, $id)
    {
        $music = LivePlayerManage::find($id);
        if (!$music) {
            return response()->json(['error' => 'Music not found'], 404);
        }
        $oldListing=$music->listening;
        $oldAndroid=$music->android;
        $oldIos=$music->ios;

        $input['listening'] =$oldListing  + 1;
        $input['android']  = $oldAndroid  + 1;
        $input['ios'] = $oldIos  + 1;

        $music->update($input);
        return response()->json('Music Listening and Device data successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $music = LivePlayerManage::find($id);
        $music->delete();
        return response()->json('Music deleted successfully');
    }
}
