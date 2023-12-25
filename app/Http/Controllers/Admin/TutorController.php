<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Teacher;
use App\Models\TeacherProfile;

class TutorController extends Controller
{
    public function index()
    {
        $tutors = Teacher::all();
        foreach ($tutors as $key => $tutor) {
            $tutor->profile = TeacherProfile::where('teacher_id', $tutor->id)->get();
        }
        return view('admin.tutors', compact('tutors'));
    }
}
