<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Http\Resources\ProgressResource;

class ProgressController extends Controller
{
    public function index()
    {
        $progress = Progress::all();
        return ProgressResource::collection($progress);
    }

    public function store(Request $request)
    {
        // ตรวจสอบและบันทึกข้อมูล
        $validatedData = $request->validate([
            'UserID' => 'required',
            'VideoID' => 'required',
            'ProgressPercentage' => 'required',
        ]);

        $progress = Progress::create($validatedData);

        return new ProgressResource($progress);
    }

    public function show($id)
    {
        $progress = Progress::findOrFail($id);
        return new ProgressResource($progress);
    }

    public function update(Request $request, $id)
    {
        // ตรวจสอบและอัปเดตข้อมูล
        $validatedData = $request->validate([
            'UserID' => 'required',
            'VideoID' => 'required',
            'ProgressPercentage' => 'required',
        ]);

        $progress = Progress::findOrFail($id);
        $progress->update($validatedData);

        return new ProgressResource($progress);
    }

    public function destroy($id)
    {
        // ค้นหา progress ที่ต้องการลบ
        $progress = Progress::findOrFail($id);

        // ลบ progress
        $progress->delete();

        return response()->json(['success' => true, 'message' => 'Progress deleted successfully']);
    }
}
