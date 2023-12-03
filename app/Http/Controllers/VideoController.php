<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Resources\VideoResource;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
{
    $videos = Video::with(['subjects'])->get();
    return VideoResource::collection($videos);
}
    public function show($id)
    {
        $video = Video::with(['subjects'])->findOrFail($id);
        return new VideoResource($video);
    }
    public function store(Request $request)
{
    $request->validate([
        'SubjectID' => 'required',
        // 'CategoryID' => 'required',
        'VideoTitle' => 'required',
        'VideoURL' => 'required',
        'Thumbnail' => 'required',
        'VideoCode'=> 'required',
        'ChannelName' => 'required',
        
    ]);

    $video = Video::create([
        'SubjectID' => $request->input('SubjectID'),
        // 'CategoryID' => $request->input('CategoryID'),
        'VideoTitle' => $request->input('VideoTitle'),
        'VideoURL' => $request->input('VideoURL'),
        'Thumbnail' => $request->input('Thumbnail'),
        'VideoCode'=> $request->input('VideoCode'),
        'ChannelName' => $request->input('ChannelName'),

    ]);

    $video->load(['subjects', 'categories']); 

    return new VideoResource($video);
}
public function update(Request $request, $id)
{
    $request->validate([
        'SubjectID' => 'required',
        // 'CategoryID' => 'required',
        'VideoTitle' => 'required',
        'VideoURL' => 'required',
        'Thumbnail' => 'required',
        'VideoCode' => 'required',
        'ChannelName' => 'required',
    ]);

    $video = Video::findOrFail($id);

    $video->update([
        'SubjectID' => $request->input('SubjectID'),
        // 'CategoryID' => $request->input('CategoryID'),
        'VideoTitle' => $request->input('VideoTitle'),
        'VideoURL' => $request->input('VideoURL'),
        'Thumbnail' => $request->input('Thumbnail'),
        'VideoCode' => $request->input('VideoCode'),
        'ChannelName' => $request->input('ChannelName'),
    ]);

    $video->load(['subjects', 'categories']); 

    return new VideoResource($video);
}
public function destroy($id)
{
    $video = Video::findOrFail($id);
    $video->delete();

    return response()->json(['message' => 'Video deleted successfully']);
}   
}
