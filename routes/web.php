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

Route::get('/', function () {
    return view('welcome');
});

// Dashboard route with controller
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
// Update user data
Route::post('/updateUser', [App\Http\Controllers\DashboardController::class, 'update']);