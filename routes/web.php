<?php

namespace App\Http\Controllers;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/',[AttendanceController::class,'index']);
    Route::get('/attendance',[AttendanceController::class,'viewAttendance']);
    Route::post('/attendance/start',[AttendanceController::class,'storeAttendanceStart'])->name('storeAttendanceStart');
    Route::post('/attendance/leave',[AttendanceController::class,'storeAttendanceLeave'])->name('storeAttendanceLeave');
});

require __DIR__.'/auth.php';
