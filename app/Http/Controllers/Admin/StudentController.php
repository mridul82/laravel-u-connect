<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\StudentProfile;

class StudentController extends Controller
{
   public function index()
   {
    $students = Student::all();
    foreach($students as $key => $student) {
        $student->profile = StudentProfile::where('student_id', $student->id)->first();
    }
    //dd($students);
    return view('admin.dashboard', compact('students'));
   }
}
