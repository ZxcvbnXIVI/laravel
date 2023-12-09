<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Resources\EnrollmentResource;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['subjects', 'users'])->get();
        return EnrollmentResource::collection($enrollments);
    }


    public function show($id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);
            return new EnrollmentResource($enrollment);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            // ตรวจสอบและสร้างข้อมูล
            $validatedData = $request->validate([
                'UserID' => 'required|exists:users,UserID',
                'SubjectID' => 'required|exists:subjects,SubjectID',
                'EnrollmentDate' => 'required|date',
            ]);

            $enrollment = Enrollment::create($validatedData);

            // โหลดข้อมูล user และ subject
            $enrollment->load(['users', 'subjects']);

            // ส่งกลับข้อมูลในรูปแบบของ EnrollmentResource
            return new EnrollmentResource($enrollment);
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
                'SubjectID' => 'exists:subjects,SubjectID',
                'EnrollmentDate' => 'date',
            ]);

            $enrollment = Enrollment::findOrFail($id);
            $enrollment->update($validatedData);

            // ส่งกลับข้อมูลในรูปแบบของ EnrollmentResource
            return new EnrollmentResource($enrollment);
        } catch (\Exception $e) {
            // จัดการข้อผิดพลาดที่ไม่ได้เกี่ยวกับ validation
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // ค้นหา Enrollment ที่ต้องการลบ
            $enrollment = Enrollment::findOrFail($id);

            // ลบ Enrollment
            $enrollment->delete();

            return response()->json(['success' => true, 'message' => 'Enrollment deleted successfully']);
        } catch (\Exception $e) {
            // จัดการข้อผิดพลาดที่ไม่ได้เกี่ยวกับ validation
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }

  
     
    public function getEnrollmentByUserID($id)
{
    try {
        // Assuming there is a 'progress' relationship defined in the Enrollment model
        $enrollments = Enrollment::with(['progress' => function ($query) use ($id) {
            $query->where('UserID', $id);
        }])->where('UserID', $id)->get();

        return response()->json(['data' => $enrollments], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}

}
