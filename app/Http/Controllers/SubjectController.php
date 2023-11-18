<?php

namespace App\Http\Controllers;

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
    $subject = Subject::create([
        'name' => $request->name,
        'category' => $request->category,
    ]);
    return response()->json(['success' => true, 'message' => 'Subject created successfully', 'data' => $subject]);


 
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
