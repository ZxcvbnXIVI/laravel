<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
{
    $users = User::all();
    return UserResource::collection($users);
}

public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'UserName' => 'required|max:255',
            'password'=> 'required|max:60', 
            'Role'=> 'required|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ตรวจสอบไฟล์รูปภาพ
        ]);

        // ดึงไฟล์รูปภาพ
        $image = $request->file('image');
        // สร้างชื่อไฟล์แบบที่ไม่ซ้ำกัน
        $imageName = time() . '.' . $image->extension();
        // เก็บไฟล์รูปภาพไว้ใน public/uploads
        Storage::disk('public')->put($imageName, file_get_contents($image));

        // รวมข้อมูลทั้งหมด
        $userData = array_merge($validatedData, ['image_path' => $imageName]);

        $user = User::create($userData);

        // ส่งกลับข้อมูลในรูปแบบของ UserResource
        return new UserResource($user);
    } catch (ValidationException $e) {
        return response()->json(['error' => $e->errors()], 422);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}



    // public function show($id)
    // {
    //     $user = User::findOrFail($id);
    //     return response()->json($user);
    // }

    public function update(Request $request, $id)
{
    try {
        // ตรวจสอบข้อมูลที่จะแก้ไข
        $validatedData = $request->validate([
            'UserName' => 'required|max:255',
            'password'=> 'required|max:60', 
            'Role'=> 'required|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ตรวจสอบไฟล์รูปภาพ
        ]);

        // ดึงข้อมูลผู้ใช้ที่ต้องการแก้ไข
        $user = User::findOrFail($id);

        // อัปเดตข้อมูล
        $user->update($validatedData);

        // ถ้ามีการอัปโหลดรูปภาพใหม่
        if ($request->hasFile('image')) {
            $newImage = $request->file('image');
            $imageName = time() . '.' . $newImage->extension();
            Storage::disk('public')->put($imageName, file_get_contents($newImage));
            
            // อัปเดตเฉพาะฟิลด์ image_path ในฐานข้อมูล
            $user->update(['image_path' => $imageName]);
        }

        // ส่งกลับข้อมูลในรูปแบบของ UserResource
        return new UserResource($user);
    } catch (ValidationException $e) {
        return response()->json(['error' => $e->errors()], 422);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}

public function destroy($id)
{
    try {
        $user = User::findOrFail($id);

        // ลบไฟล์รูปภาพจาก storage (ถ้ามี)
        if (!is_null($user->image_path)) {
            Storage::disk('public')->delete($user->image_path);
        }

        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error deleting user: ' . $e->getMessage(),
        ]);
    }
}
}
