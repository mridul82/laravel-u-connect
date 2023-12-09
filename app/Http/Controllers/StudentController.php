<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class StudentController extends Controller
{
    public function register(Request $request) {
        // Validate and create student
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'user_type' => 'required',
          ]);

          if($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
          }



          $student = new Student;
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone_number = $request->phone_number;
            $student->password = Hash::make($request->password);
            $student->user_type = $request->user_type;
            $student->save();


        $token = $student->createToken('student_auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $student,
            'status' => 200,
        ]);
    }


    public function login(Request $request) {
        // Attempt login

        $student = Student::where('email', $request->email)->first();


        if (!$student || !Hash::check($request->password, $student->password)) {
            return response([
                'message' => ['These credentials do not match our records.'],

            ], 404);
        }

        $token = $student->createToken('student_auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $student,
            'status' => 200,
        ]);
    }
}
