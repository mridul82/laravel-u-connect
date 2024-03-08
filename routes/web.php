<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TutorController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ExamController;
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
    Route::get('/tutor-view/{id}', [TutorController::class, 'view']);
    Route::post('/tutor-activate/{id}', [TutorController::class, 'activateTutor'])->name('tutor-activate');
    Route::post('/tutor-deactivate/{id}', [TutorController::class, 'deactivateTutor'])->name('tutor-deactivate');
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/exams', [ExamController::class, 'index']);
    Route::post('/add-exam', [ExamController::class, 'addExam'])->name('add-exam');
    Route::get('/exam/delete/{exam_id}', [ExamController::class, 'delete']);
    Route::get('/logout',  [AuthController::class, 'logout']);
});

Route::get('/reset-password/{token}', [NewPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [NewPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
