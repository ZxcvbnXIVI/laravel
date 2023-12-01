<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'CategoryName' => 'required|max:255',
            ]);

            $category = Category::create($validatedData);

            return new CategoryResource($category);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }


    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return new CategoryResource($category);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }




public function update(Request $request, $id)
{
    try {
        $validatedData = $request->validate([
            'CategoryName' => 'required|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return new CategoryResource($category); // ใช้ CategoryResource ในการสร้าง response
    } catch (ValidationException $e) {
        return response()->json(['error' => $e->errors()], 422);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}



public function destroy($id)
{
    try {
        $category = Category::findOrFail($id);
        $deletedCategory = clone $category;
        $category->delete();

        return new CategoryResource($deletedCategory);
    } catch (\Exception $e) {
        \Log::error($e->getMessage()); // แสดงข้อความข้อผิดพลาดใน logs
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}


}
