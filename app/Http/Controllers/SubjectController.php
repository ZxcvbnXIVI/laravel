<?php

namespace App\Http\Controllers;
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

//เพิ่มข้อมูล
public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // บันทึก storage/app/public/images/
            Image::make($image)->save(storage_path('app/public/images/' . $filename));
        }

        $subject = Subject::create([
            'name' => $request->name,
            'category' => $request->category,
            'image' => $filename ?? 'default.jpg', // ให้ใช้ 'default.jpg' ถ้า $filename ไม่ได้ถูกกำหนดค่า
        ]);

        return response()->json([
            'success' => true,
            'message' => 'สร้างรายการเรียบร้อย',
            'data' => $subject
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage(),
            'data' => null
        ], 500);
    }
}

//update
public function update(Request $request, Subject $subject)
{
    $subject->update([
        'name' => $request->name,
        'category' => $request->category,

    ]);
    return response()->json(['success' => true, 'message' => 'Subject created successfully', 'data' => $subject]);


}
//delete
public function destroy(Subject $subject)
{
    $subject->delete();

    return response()->json(['success' => true, 'message' => 'Subject deleted successfully']);
}

}
