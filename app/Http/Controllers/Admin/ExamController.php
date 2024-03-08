<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Exam;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('admin.exams', compact('exams'));
    }

    public function addExam(Request $request)
    {
        Exam::create($request->all());

        return back()->with('success', 'data Upload successfully');
    }

    public function delete($id)
    {
        Exam::where('id', $id)->delete();
        return back()->with('success', 'data deleted successfully');
    }
}
