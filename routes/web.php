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

});

