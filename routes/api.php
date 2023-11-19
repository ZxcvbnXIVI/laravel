<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SubjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('blog-posts', BlogPostController::class);
Route::get('/items', [ApiController::class, 'index']);
Route::get('/items/{id}', [ApiController::class, 'show']);
// เพิ่ม route สำหรับ CRUD operations ของ subjects
Route::get('/subjects', [SubjectController::class, 'index']);
Route::post('/subjects', [SubjectController::class, 'store']); 
Route::post('/subjects/{subject}', [SubjectController::class, 'update']); //ใช้ put ส่ง formdataไม่ได้
Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy']);



