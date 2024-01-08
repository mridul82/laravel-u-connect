<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentProfile;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{


    public function registerStudent(Request $request)
{
    // Validation rules for student registration
    $validatedData = $request->validate([
        'name' => 'required',
        'phone' => 'required|unique:students,phone_number', // Unique validation for phone number in students table
        'email' => 'required|email|unique:students,email', // Unique validation for email in students table
        'password' => 'required',
    ]);

    // Create a new Student instance and save to the database
    $student = new Student;
    $student->name = $validatedData['name'];
    $student->email = $validatedData['email'];
    $student->phone_number = $validatedData['phone'];
    $student->password = Hash::make($validatedData['password']);
    $student->user_type = 'students'; // Set the user type for students
    $student->profile_completed = false;
    //dd($validatedData);
    $student->save();

    // Generate token for authentication (if using Sanctum or Passport)
    $token = $student->createToken('student_auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'user' => $student,
        'isProfileComplete' => $student->profile_completed,
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
            'isProfileComplete' => $student->profile_completed,
            'status' => 200,
        ]);
    }


    public function profile(Request $request)
    {
        $user = auth()->user();

        //dd($user->id);
        $profile = new StudentProfile;

        $profile->register_id = mt_rand(100000, 999999);;
        $profile->whatapp_no = $request->whatapp_no;
        $profile->gender = $request->gender;
        $profile->present_address = $request->present_address;
        $profile->class = $request->class;
        $profile->school = $request->school;
        $profile->board = $request->board;
        $profile->subjects = $request->subjects;
        $profile->guardian_name = $request->guardian_name;
        $profile->guardian_contact = $request->guardian_contact;
        $profile->tutor_gender = $request->tutor_gender;
        $profile->no_of_classes = $request->no_of_classes;
        $profile->reference_id = $request->reference_id;
        $profile->student_id = $user->id;
        if ($profile->save()) {
            // Update the 'profile_completed' field for the authenticated user
            $user->profile_completed = "true";
            $user->save();
            Mail::to($user->email)->send(new RegistrationMail($user));

        }



        if($file = $request->file('profile_pic')) {
            $uploadFile =sha1(time().rand()).'.'.$file->getClientOriginalExtension();
            $file->move('student/profile_pic/'.$profile->register_id.'/'.$request->register_id, $uploadFile);
            $profile->profile_pic = 'student/profile_pic/'.$profile->register_id.'/'.$uploadFile;
            $profile->save();
        }

        return response()->json([
            'profile' => $profile,
            'status' => 200,
        ]);

    }


//     public function getProfile() {
//
//         $user = auth()->user();
//
//         if($user!= null) {
//             $profile = StudentProfile::where('student_id', $user->id)->latest()->first();
//             $profile->student = Student::where('id', $profile->student_id)->first();
//             if($profile->profile_pic != null) {
//                 $profile->imageUrl = asset($profile->profile_pic);
//             } else {
//                 $profile->imageurl = null;
//             }
//
//             return response()->json([
//                 'profile' => $profile,
//                 'imageUrl' => $profile->imageUrl,
//                 'status' => 200,
//             ]);
//         } else {
//             return response()->json([
//                 'profile' => null,
//                 'imageUrl' => null,
//                 'status' => 404,
//             ]);
//         }
//     }


    public function getProfile() {
        $user = auth()->user();

        if ($user) {
            $profile = StudentProfile::where('student_id', $user->id)->latest()->first();

            if ($profile) {
                $profile->student = Student::where('id', $profile->student_id)->first();

                if ($profile->profile_pic != null) {
                    $profile->imageUrl = asset($profile->profile_pic);
                } else {
                    $profile->imageUrl = null; // Corrected attribute name
                }

                return response()->json([
                    'profile' => $profile,
                    'imageUrl' => $profile->imageUrl,

                    'status' => 200,
                ]);
            } else {
                return response()->json([
                    'profile' => null,
                    'imageUrl' => null,

                    'status' => 404,
                ]);
            }
        } else {
            return response()->json([
                'profile' => null,
                'imageUrl' => null,

                'status' => 404,
            ]);
        }


    }






}
