<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Progress; 
use App\Http\Resources\ProgressResource;

class ProgressController extends Controller
{
    public function index()
    {
        $progress = Progress::with(['videos', 'users','enrollments'])->get();
        return ProgressResource::collection($progress);
    }

    public function store(Request $request)
{
    try {
        // ตรวจสอบและสร้างข้อมูล
        $validatedData = $request->validate([
            'UserID' => 'required|exists:users,UserID',
            'VideoID' => 'required|exists:videos,VideoID',
            'EnrollmentId' => 'required|exists:enrollments,EnrollmentID',
            'ProgressPercentage' => 'required|numeric|min:0|max:100',
            'lastViewedTimestamp' => 'required|date',
        ]);

        $progress = Progress::create($validatedData);

        // โหลดข้อมูล user, video, และ enrollment
        $progress->load(['user', 'video', 'enrollment']);

        // ส่งกลับข้อมูลในรูปแบบของ ProgressResource
        return new ProgressResource($progress);
    } catch (\Exception $e) {
        // จัดการข้อผิดพลาดที่ไม่ได้เกี่ยวกับ validation
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}
public function update(Request $request, $id)
{
    try {
        // ตรวจสอบและอัปเดตข้อมูล
        $validatedData = $request->validate([
            'UserID' => 'exists:users,UserID',
            'VideoID' => 'exists:videos,VideoID',
            'EnrollmentId' => 'exists:enrollments,EnrollmentID',
            'ProgressPercentage' => 'numeric|min:0|max:100',
            'lastViewedTimestamp' => 'date',
        ]);

        $progress = Progress::findOrFail($id);
        $progress->update($validatedData);

        // โหลดข้อมูล user, video, และ enrollment
        $progress->load(['user', 'video', 'enrollment']);

        // ส่งกลับข้อมูลในรูปแบบของ ProgressResource
        return new ProgressResource($progress);
    } catch (\Exception $e) {
        // จัดการข้อผิดพลาดที่ไม่ได้เกี่ยวกับ validation
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}

    public function show($id)
    {
        $progress = Progress::findOrFail($id);
        return new ProgressResource($progress);
    }

  

    
public function destroy($id)
{
    try {
        $progress = Progress::findOrFail($id);
        $progress->delete();
        return new ProgressResource($progress);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}
//get progess by user id
public function getProgressByUserId($id)
{
    try {
        $progress = Progress::where('UserID', $id)->get();
        return ProgressResource::collection($progress);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}
// update persentage in progress by progress id

public function updateProgressPercentage(Request $request)
    {
        $progressId = $request->input('ProgressID');
        $progressPercentage = $request->input('ProgressPercentage');

        // Find the progress record by ID
        $progress = Progress::find($progressId);

        if (!$progress) {
            // Handle the case when the progress record is not found
            return response()->json(['error' => 'Progress not found'], 404);
        }

        // Update the ProgressPercentage column
        $progress->ProgressPercentage = $progressPercentage;
        $progress->save();

        return response()->json(['message' => 'Progress percentage updated successfully']);
    }



}
