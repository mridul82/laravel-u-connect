<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Teacher;
use App\Models\TeacherProfile;
use App\Models\ActivateModules;

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

    public function view($id)
    {
        $tutor = TeacherProfile::where('teacher_id', $id)->first();
        if($tutor) {
            $tutor->credential = Teacher::where('id', $id)->first();
        }

        //dd($tutor);
        return view('admin.tutor_view', compact('tutor'));
    }

    public function activateTutor($id)
    {
       // dd($id);
        $activate_module = ActivateModules::where('module_name', 'teacher')->where('module_id', $id)->where('is_active', 0)->first();
        //dd($activate_module);
        if(!$activate_module)  {
            $activate_module = new ActivateModules;
            $activate_module->module_name = 'teacher';
            $activate_module->module_id = $id;
            $activate_module->priority = 'NULL';
            $activate_module->is_active = 1;
            $activate_module->save();
        }
        return redirect()->back()->with('error', 'Record not found, Please contact admin');

    }

    public function deactivateTutor($id)
    {

            $activate_module = ActivateModules::where('module_name', 'teacher')->where('module_id', $id)->where('is_active', 1)->first();
            $activate_module->is_active = 0;
            $activate_module->delete();

            return redirect()->back()->with('error', 'Record not found, Please contact admin');

    }


}
