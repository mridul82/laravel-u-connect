<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\controllers\NewPasswordController;
use App\Http\Controllers\ExamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::post('/teacher-register', [TeacherController::class, 'register']);
Route::post('/teacher-login', [TeacherController::class, 'login']);

Route::post('/student-register', [StudentController::class, 'registerStudent']);

Route::post('/student-login', [StudentController::class, 'login']);

// Route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
// Route::post('reset-password', [NewPasswordController::class, 'reset']);

//Route::get('forget-password', [NewPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password', [NewPasswordController::class, 'submitForgetPasswordForm']);

//teachers
Route::get('/get-teachers', [TeacherController::class, 'getTeachers']);




Route::middleware('auth:sanctum')->group(function () {
    Route::post('/teacher-profile', [TeacherController::class, 'profile']);
    Route::get('/teacher-profile', [TeacherController::class, 'getProfile']);

    Route::post('/student-profile', [StudentController::class, 'profile']);
    Route::get('/student-profile', [StudentController::class, 'getProfile']);

    Route::get('/sendmail', [TeacherController::class, 'sendmail']);

    //Exam
    Route::get('/exams/{id}', [ExamController::class, 'index']);
    Route::post('/add-exam', [ExamController::class, 'addExam']);
    Route::get('/exam-summary/{id}', [ExamController::class, 'examSummary']);


});




