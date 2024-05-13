<?php

use Illuminate\Support\Facades\Route;

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

Route::get('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.post');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::get('/language', [\App\Http\Controllers\DashboardController::class, 'language'])->name('language');
    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::resource('schools', \App\Http\Controllers\SchoolController::class);
    Route::resource('groups', \App\Http\Controllers\GroupController::class);
    Route::resource('classes', \App\Http\Controllers\ClassController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('teachers', \App\Http\Controllers\TeacherController::class);
    Route::resource('parents', \App\Http\Controllers\ParentController::class);
    Route::resource('students', \App\Http\Controllers\StudentController::class);
    Route::resource('buses', \App\Http\Controllers\BusController::class);
    Route::resource('food-menu', \App\Http\Controllers\FoodMenuController::class);
    Route::resource('files', \App\Http\Controllers\FilesController::class);
    Route::resource('announcements', \App\Http\Controllers\AnnouncementController::class);
    Route::resource('daily-reports', \App\Http\Controllers\DailyReportController::class);
    Route::resource('messages', \App\Http\Controllers\MessageController::class);
    Route::resource('photos', \App\Http\Controllers\PhotoController::class);
    Route::resource('logs', \App\Http\Controllers\LogController::class);

});

