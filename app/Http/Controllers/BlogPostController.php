<?php

namespace App\Http\Controllers;

use App\Models\BlogPost; // เพิ่มบรรทัดนี้
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::all();
        return response()->json($posts);
    }
}


