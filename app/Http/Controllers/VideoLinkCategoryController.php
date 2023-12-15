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
            return new VideoLinkCategoryResource($videoLinkCategoriesResource);
        } catch (ValidationException $e) {
            // กรณีเกิดข้อผิดพลาดในการ validate
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // กรณีเกิดข้อผิดพลาดอื่น ๆ
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getVdoByCategoryID($id)
    {
        try {
            // Retrieve data with the join operation and eager load the 'video' relationship
            $videoLinkCategories = VideoLinkCategory::with('video')
                ->join('videos', 'videos.VideoID', '=', 'videolinkcategory.VideoID')
                ->where('videolinkcategory.CategoryID', $id)
                ->select('videos.*', 'videolinkcategory.*') // Select all columns from both tables
                ->get();
    
            // Convert the data into a Resource Collection
            $videoLinkCategoriesResource = VideoLinkCategoryResource::collection($videoLinkCategories);
    
            // Return the data to the client using the Resource Collection
            return $videoLinkCategoriesResource;
        } catch (\Exception $e) {
            // Handle errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    






}