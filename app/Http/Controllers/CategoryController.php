<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
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
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }


    public function update(Request $request, $id)
{
    try {
        $validatedData = $request->validate([
            'CategoryName' => 'required|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return response()->json(['success' => true, 'message' => 'Category updated successfully']);
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
            $category->delete();

            return response()->json(['message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }
}
