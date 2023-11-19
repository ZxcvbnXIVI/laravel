<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    
//getAll
public function index()
{
    $subjects = Subject::all();
    return response()->json($subjects);
}
//เพิ่่ม
public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ตรวจสอบ
        ]);

        $subject = new Subject;
        $subject->name = $request->name;
        $subject->category = $request->category;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            // Save at storage/app/public/images/subjects
            Storage::putFileAs('public/images/subjects', $image, $imageName);

            // Save DB
            $subject->image = $imageName;
        }
        $subject->save();

        return response()->json([
            'success' => true,
            'message' => 'Subject created successfully',
            'data' => $subject
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error creating subject: ' . $e->getMessage(),
        ]);
    }
}
//update
public function update(Request $request, $id)
{
    try {
        // ตรวจสอบข้อมูลที่ส่งมาจากฟอร์ม
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ตรวจสอบไฟล์รูปภาพ
        ]);

        // ค้นหา subject ที่ต้องการอัปเดต
        $subject = Subject::findOrFail($id);

        // อัปเดตข้อมูล
        $subject->name = $request->name;
        $subject->category = $request->category;

        // ตรวจสอบการอัปโหลดรูปภาพ
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            // ลบรูปเก่า (ถ้ามี)
            if ($subject->image) {
                Storage::delete('public/images/subjects/'.$subject->image);
            }

            // บันทึกไฟล์รูปภาพใหม่
            Storage::putFileAs('public/images/subjects', $image, $imageName);
            $subject->image = $imageName;
        }

        $subject->save();

        return response()->json([
            'success' => true,
            'message' => 'Subject updated successfully',
            'data' => $subject
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation error: ' . $e->validator->errors(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error updating subject: ' . $e->getMessage(),
        ]);
    }
}


//delete
public function destroy(Subject $subject)
{
    $subject->delete();

    return response()->json(['success' => true, 'message' => 'Subject deleted successfully']);
}

}