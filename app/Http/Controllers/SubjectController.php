<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Resources\SubjectResource;
use Illuminate\Validation\ValidationException;

class SubjectController extends Controller
{
    public function index()
{
    $subjects = Subject::all();
    return SubjectResource::collection($subjects);
}

public function store(Request $request)
{
    try {
        $request->validate([
            'SubjectName' => 'required|string',
            'Description' => 'required|string',
            'PlaylistLink' => 'required|string',
        ]);

        $subject = new Subject;
        $subject->SubjectName = $request->SubjectName;
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
//     public function searchSubjectsContainingM()
// {
//     $subjects = Subject::where('SubjectName', 'like', '%M%')->get();

//     return $subjects;
// }
}