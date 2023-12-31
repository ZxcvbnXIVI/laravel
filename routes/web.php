<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WebController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [WebController::class, 'showMainPage']);
// Route::get('/login', 'App\Http\Controllers\AuthController@showLoginForm')->name('login');
// Route::post('/login', 'App\Http\Controllers\AuthController@login');
// Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
// Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');


