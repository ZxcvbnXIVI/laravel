<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'SubjectName' => 'required|string',
                'Description' => 'required|string',
                'PlaylistLink' => 'required|string',
            ]);

            $subject = new Subject;
            $subject->SubjectName = $request->SubjectName;
            $subject->Description = $request->Description;
            $subject->PlaylistLink = $request->PlaylistLink;
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

    public function update(Request $request, $id)
    {
        try {
            $subject = Subject::findOrFail($id);

            $request->validate([
                'SubjectName' => 'string',
                'Description' => 'string',
                'PlaylistLink' => 'string',
            ]);

            $subject->fill($request->all());
            $subject->save();

            return response()->json([
                'success' => true,
                'message' => 'Subject updated successfully',
                'data' => $subject
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating subject: ' . $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $subject = Subject::findOrFail($id);
            $subject->delete();

            return response()->json(['success' => true, 'message' => 'Subject deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting subject: ' . $e->getMessage(),
            ]);
        }
    }
}