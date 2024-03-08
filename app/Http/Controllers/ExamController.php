<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\StudentExam;
use Carbon\Carbon;

class ExamController extends Controller
{
    public function index($id)
    {
        $examIdsInStudentExam = StudentExam::where('is_active', 1)->pluck('exam_id')->toArray();
        //dd($examIdsInStudentExam);
        if(!$examIdsInStudentExam) {
            $exams = Exam::all();
        } else {
            $exams = Exam::whereNotIn('id', $examIdsInStudentExam)->get();
        }
      // dd($exams);

        $tests = Exam::select('test_series_name')
        ->distinct()
        ->get();
        $board_test = Exam::where('test_series_name', 'Target Board Test')->get();
        return response()->json([
            'exams' => $exams,
            'tests' => $tests,
            'board_test' => $board_test,
            'status' => 200,
        ]);

    }

    public function addExam(Request $request)
    {

        $requestData = $request->all(); // Assuming the JSON data is sent via POST request
        $currentDateTime = Carbon::now();// Get the current datetime
        $savedExams = []; // Array to store saved exam data

    // Iterate over the cartExams array
        foreach ($requestData['cartExams'] as $exam) {

            // Check if data with the same student_id, exam_id, and is_active already exists
        $existingExam = StudentExam::where('student_id', $requestData['user']['id'])
        ->where('exam_id', $exam['id'])
        ->where('is_active', 1) // Assuming we only check for active exams
        ->first();

        if ($existingExam) {
            // Return an error response if the data already exists
            return response()->json(['msg' => 'Exam already exists for this student'], 400);
        }

            $studentExam = new StudentExam();
            $studentExam->student_id = $requestData['user']['id']; // Assuming user ID is present in the JSON
            $studentExam->exam_id = $exam['id']; // Assuming the exam ID is present in the cartExams array
            $studentExam->test_code = $exam['test_code']; // Assuming the test code is present in the cartExams array
            $studentExam->test_price = $exam['test_price']; // Assuming the test price is present in the cartExams array
            $studentExam->test_date = $requestData['selectedDate']; // Assuming the selectedDate is available in the request
            $studentExam->test_time = $requestData['selectedTime']; // Assuming the selectedTime is available in the request

            // Check if test_date and test_time are greater than or equal to the current datetime
                if (Carbon::parse($studentExam->test_date . ' ' . $studentExam->test_time)->gte($currentDateTime)) {
                    $studentExam->is_active = 1; // Set is_active to 1
                } else {
                    $studentExam->is_active = 0; // Set is_active to 0
                }
            $studentExam->save();




        // Push the saved exam data to the array
        $savedExams[] = $studentExam;
        }

        // Return the saved data with a status of 200
        return response()->json([
            'message' => 'Exams saved successfully',
            'data' => $savedExams,

        ], 200);

    }

    public function examSummary($id)
    {
        $exams = StudentExam::where('student_id', $id)->where('is_active', 1)->get();
        foreach ($exams as $key => $exam) {
    		$exam->detail = Exam::where('id', $exam->exam_id)->first();
    	}
        $total_price = StudentExam::where('student_id',  $id)->where('is_active', 1)->sum('test_price');
        return response()->json([
            'msg' => 'Exam Details Fetch sucessfully!!',
            'data' => $exams,
            'total_price' => $total_price,
        ], 200);
    }
}
