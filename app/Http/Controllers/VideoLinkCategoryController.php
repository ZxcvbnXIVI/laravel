<?php

namespace App\Http\Controllers;

use App\Models\VideoLinkCategory;
use Illuminate\Http\Request;
use App\Http\Resources\VideoLinkCategoryResource;
use Illuminate\Validation\ValidationException;

class VideoLinkCategoryController extends Controller
{

    public function index()
    {
        try {
            // ดึงข้อมูลทั้งหมดจากฐานข้อมูล
            $videoLinkCategories = VideoLinkCategory::all();

            // แปลงข้อมูลเป็น Resource Collection
            $videoLinkCategoriesResource = VideoLinkCategoryResource::collection($videoLinkCategories);

            // คืนข้อมูลให้กับ client โดยใช้ Resource Collection
            return $videoLinkCategoriesResource;
        } catch (\Exception $e) {
            // กรณีเกิดข้อผิดพลาด
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            // ตรวจสอบและ validate ข้อมูลที่ได้รับจาก Request
            $validatedData = $request->validate([
                'VideoID' => 'required|integer',
                'CategoryID' => 'required|integer',
            ]);

            // สร้างหรือบันทึกข้อมูลใหม่ในฐานข้อมูล
            $videoLinkCategoriesResource = VideoLinkCategory::create($validatedData);

            // คืนข้อมูลให้กับ client โดยใช้ Resource
            return new VideoLinkCategoryResource($videoLinkCategories);
        } catch (ValidationException $e) {
            // กรณีเกิดข้อผิดพลาดในการ validate
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // กรณีเกิดข้อผิดพลาดอื่น ๆ
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




}