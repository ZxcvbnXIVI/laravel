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
            $request->validate([
                'CategoryName' => 'required',
                'CategoryImage' => 'required',
                // Add any other validation rules for other fields
            ]);
    
            $category = Category::create([
                'CategoryName' => $request->input('CategoryName'),
                'CategoryImage' => $request->input('CategoryImage'),
                // Add any other fields as needed
            ]);
    
            return new CategoryResource($category);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
        // $image = $request->file('image');
        // $imageName = time() . '.' . $image->extension();

        // // Save the image to storage (if needed)
        // $image->storeAs('public/uploads', $imageName);

        // // Use the image path directly without storing the file
        // $categoryData = array_merge($validatedData, ['image_path' => 'public/uploads/' . $imageName]);
        // $category = Category::create($categoryData);

    //     return response()->json(['category' => new CategoryResource($category)], 201);
    // } catch (ValidationException $e) {
    //     return response()->json(['error' => $e->errors()], 422);
    // } catch (\Exception $e) {
    //     return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    // }




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
            $request->validate([
                'CategoryName' => 'required',
                'CategoryImage' => 'required',
                // Add any other validation rules for other fields
            ]);
    
            $category = Category::findOrFail($id);
    
            $category->update([
                'CategoryName' => $request->input('CategoryName'),
                'CategoryImage' => $request->input('CategoryImage'),
                // Add any other fields as needed
            ]);
    
            return new CategoryResource($category);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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
        // \Log::error($e->getMessage()); // แสดงข้อความข้อผิดพลาดใน logs
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}


}
