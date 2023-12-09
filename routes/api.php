<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\VideoLinkCategoryController;
use App\Http\Controllers\BookmarkController;


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
Route::apiResource('videolink', VideoLinkCategoryController::class);
Route::apiResource('bookmark', BookmarkController::class);
Route::apiResource('favorites', FavoriteController::class);


Route::post('/enrollments/store', [EnrollmentController::class, 'store']);
Route::get('/enrollments/user/{id}', [EnrollmentController::class, 'getEnrollmentByUserID']);
Route::apiResource('progress', ProgressController::class);

Route::post('/videos', [VideoController::class, 'store']);
Route::get('/progress/user/{id}', [ProgressController::class, 'getProgressByUserID']);
Route::put('/progress/percentage/{id}', [ProgressController::class, 'updateProgressPercentage']);

Route::get('/favorites/user/{id}', [FavoriteController::class, 'getFavoriteByUserId']);
Route::get('/bookmark/user/{id}', [BookmarkController::class, 'getBookmarkByUserId']);



// Route::apiResource('videolinkcategory', VideoLinkCategoryController::class);
// Route::post('/enrollments/store', [EnrollmentController::class, 'store']);
// Route::post('/videos', [VideoController::class, 'store']);
// Route::get('/videos', [VideoController::class, 'index']);
// Route::get('/videos/{id}', [VideoController::class, 'show']);





