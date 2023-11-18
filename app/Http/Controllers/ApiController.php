<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ApiController extends Controller
{
    public function index()
    {
        // คืนค่ารายการทั้งหมดจากฐานข้อมูล
        $data = [
            'message' => 'Hello, this is your API!'
        ];

        return response()->json($data);
    }

    public function show($id)
    {
        // คืนค่ารายการที่มี $id จากฐานข้อมูล
        $data = [
            'id' => $id,
            'message' => 'This is the details for item ' . $id
        ];

        return response()->json($data);
    }
}
