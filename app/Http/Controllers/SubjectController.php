<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Resources\SubjectResource;
use Illuminate\Validation\ValidationException;

class SubjectController extends Controller
{
//     public function index()
    
// {
//     $subjects = Subject::with(['categories'])->get();
//     return SubjectResource::collection($subjects);
// }
public function index()
{
    $subjectsWithVideosAndCategories = Subject::with('videos', 'categories')->get();

    return SubjectResource::collection($subjectsWithVideosAndCategories);
}

public function store(Request $request)
{
    try {
        $request->validate([
            'SubjectName' => 'required|string',
            'CategoryID' => 'required',
            'Description' => 'required|string',
            'PlaylistLink' => 'required|string',
        ]);

        $subject = new Subject;
        $subject->SubjectName = $request->SubjectName;
        $subject->CategoryID = $request->CategoryID;
        $subject->Description = $request->Description;
        $subject->PlaylistLink = $request->PlaylistLink;
        $subject->save();

        // ส่งกลับข้อมูลในรูปแบบของ SubjectResource
        return new SubjectResource($subject);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error creating subject: ' . $e->getMessage(),
        ]);
    }
}

public function update(Request $request, $id)
{
    try {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'SubjectName' => 'string',
            'CategoryID' =>'integer',
            'Description' => 'string',
            'PlaylistLink' => 'string',
        ]);

        $subject->fill($request->all());
        $subject->save();

        // ใช้ SubjectResource เพื่อรีเทิร์นข้อมูลใหม่
        return new SubjectResource($subject);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error updating subject: ' . $e->getMessage(),
        ]);
    }
}

public function destroy($id)
{
    try {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        // ใช้ SubjectResource เพื่อรีเทิร์นข้อมูลที่ถูกลบ
        return new SubjectResource($subject);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error deleting subject: ' . $e->getMessage(),
        ]);
    }
}
public function show($subjectID)
    {
        $subjectWithVideos = Subject::with('videos')->find($subjectID);

        if (!$subjectWithVideos) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        return new SubjectResource($subjectWithVideos);
    }

}