<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TutorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin/register', function () {
    return view('admin.auth');
});

Route::get('/', [AuthController::class, 'auth']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'doRegister']);
Route::post('/login', [AuthController::class, 'doLogin']);
Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
    Route::get('/tutors', [TutorController::class, 'index']);
    Route::get('/logout',  [AuthController::class, 'logout']);
});
