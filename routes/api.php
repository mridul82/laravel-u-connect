<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

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

Route::post('/student-register', [StudentController::class, 'register']);
Route::post('/student-login', [StudentController::class, 'login']);

Route::middleware('auth:sanctum')
        ->get('/exam-results/{examId}',
        [ExamResultController::class, 'getExamResults']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/teacher-profile', [TeacherController::class, 'profile']);
    Route::get('/teacher-profile', [TeacherController::class, 'getProfile']);

    Route::post('/student-profile', [StudentController::class, 'profile']);
    Route::get('/student-profile', [StudentController::class, 'getProfile']);
});




