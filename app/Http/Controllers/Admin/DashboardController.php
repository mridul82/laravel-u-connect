<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\StudentProfile;

use App\Models\Teacher;
use App\Models\TeacherProfile;
use App\Models\ActivateModules;

class DashboardController extends Controller
{
    public function index()
    {
        $user = \Auth::guard()->user();

        $students = Student::all();
    foreach($students as $key => $student) {
        $student->profile = StudentProfile::where('student_id', $student->id)->first();
    }

    $teachers = Teacher::all();
    foreach($teachers as $key => $teacher) {
        $teacher->profile = TeacherProfile::where('teacher_id', $teacher->id)->first();
        $teacher->reference = StudentProfile::where('reference_id', $teacher->register_id)->get();
        $teacher->reference_count = StudentProfile::where('reference_id', $teacher->register_id)->count();
        if($teacher->profile) {
            $teacher->active = ActivateModules::where('module_name', 'teacher')->where('is_active', 1)->where('module_id', $teacher->id)->first();
        }

    }

//dd($teachers);
        return view('admin.dashboard', compact('user', 'students', 'teachers'));
    }
}
