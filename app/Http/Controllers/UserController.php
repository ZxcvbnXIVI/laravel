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


    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'UserName' => 'required|max:255',
            'UserType' => 'required|max:255',
            'EnrollmentDate' => 'required|date',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        return response()->json(['success' => true, 'message' => 'User updated successfully', 'user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }
}
