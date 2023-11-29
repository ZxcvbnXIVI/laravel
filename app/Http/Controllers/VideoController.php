<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Resources\VideoResource;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with(['subjects', 'categories'])->get();
        return VideoResource::collection($videos);
    }
    public function show($id)
    {
        $video = Video::with(['subjects', 'categories'])->findOrFail($id);
        return new VideoResource($video);
    }
    public function get($id)
{
    try {
        // ค้นหา Video ตาม ID
        $video = Video::with('subjects', 'categories')->findOrFail($id);

        // Return ผลลัพธ์
        return new VideoResource($video);
    } catch (\Exception $e) {
        // จัดการข้อผิดพลาดที่ไม่ได้เกี่ยวกับ validation
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'SubjectID' => 'required|exists:subjects,SubjectID',
                'CategoryID' => 'required|exists:categories,CategoryID',
                'VideoTitle' => 'required|max:255',
                'VideoURL' => 'required|url|max:255',
                'Thumbnail' => 'required|max:255',
                'ChannelName' => 'required|max:255',
            ]);

            $video = Video::create($validatedData);

            return response()->json(['success' => true, 'data' => $video]);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'An error occurred while processing your request.'], 500);
        }
    }



    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'SubjectID' => 'required|exists:subjects,SubjectID',
                'CategoryID' => 'required|exists:categories,CategoryID',
                'VideoTitle' => 'required|max:255',
                'VideoURL' => 'required|url|max:255',
                'Thumbnail' => 'required|max:255',
                'ChannelName' => 'required|max:255',
            ]);

            $video = Video::findOrFail($id);
            $video->update($validatedData);

            return response()->json(['success' => true, 'data' => $video]);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'An error occurred while processing your request.'], 500);
        }
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()->json(['success' => true, 'message' => 'Video deleted successfully']);
    }
}
