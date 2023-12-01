<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProgressController;


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
Route::apiResource('subjects', SubjectController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('videos', VideoController::class);
Route::apiResource('enrollments', EnrollmentController::class);
Route::post('/enrollments/store', [EnrollmentController::class, 'store']);
Route::apiResource('progress', ProgressController::class);
Route::post('/videos', [VideoController::class, 'store']);
// Route::get('/videos', [VideoController::class, 'index']);
// Route::get('/videos/{id}', [VideoController::class, 'show']);



