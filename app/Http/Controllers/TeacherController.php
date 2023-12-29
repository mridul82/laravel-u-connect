<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class TeacherController extends Controller
{


    public function register(Request $request) {
        // Validate and create teacher
        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required',
          ]);

          if($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
          }



          $teacher = new Teacher;
            $teacher->name = $request->name;
            $teacher->email = $request->email;
            $teacher->phone_number = $request->phone_number;
            $teacher->password = Hash::make($request->password);
            $teacher->user_type = $request->user_type;
            $teacher->profile_completed = 'false';
            $teacher->save();


        $token = $teacher->createToken('teacher_auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $teacher,
            'isProfileComplete' => $teacher->profile_completed,
            'status' => 200,
        ]);
    }

    public function login(Request $request) {
        // Attempt login

        $teacher = Teacher::where('email', $request->email)->first();
        //dd($teacher);



        if (!$teacher || !Hash::check($request->password, $teacher->password)) {
            return response([
                'message' => ['These credentials do not match our records.'],

            ], 404);
        }

        $token = $teacher->createToken('teacher_auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $teacher,
            'isProfileComplete' => $teacher->profile_completed,
            'status' => 200,
        ]);
    }


    public function profile(Request $request)
    {
        $user = auth()->user();
        //dd($user->id);
        $profile = new TeacherProfile;

        $profile->register_id = mt_rand(100000, 999999);;
        $profile->whatapp_no = $request->whatapp_no;
        $profile->gender = $request->gender;
        $profile->present_address = $request->present_address;
        $profile->area_locality = $request->area_locality;
        $profile->city = $request->city;
        $profile->pin_code = $request->pin_code;
        $profile->highest_qualification = $request->highest_qualification;
        $profile->specialisation = $request->specialisation;
        $profile->preferred_subject = $request->preferred_subject;
        $profile->preferred_location = $request->preferred_location;
        $profile->preferred_time = $request->preferred_time;
        $profile->teacher_id = $user->id;
        $profile->save();


        if($file = $request->file('profile_pic')) {
            $uploadFile =sha1(time().rand()).'.'.$file->getClientOriginalExtension();
            $file->move('tutor/profile_pic/'.$profile->register_id.'/'.$request->register_id, $uploadFile);
            $profile->profile_pic = 'tutor/profile_pic/'.$profile->register_id.'/'.$uploadFile;
            $profile->save();
        }

        //$files = [];
        if($files = $request->file('education_document1')) {
            // foreach($request->file('files') as $key => $file) {
                $uploadFile =sha1(time().rand()).'.'.$files->getClientOriginalExtension();
              //  $destinationPath = $file->storeAs('profile/tutor/documnets/'.$request->register_id, $uploadFile);
                $files->move('tutor/docs/'.$request->register_id, $uploadFile);
                $profile->education_document1 = 'tutor/docs/'.$profile->register_id.'/'.$uploadFile;
                $profile->save();
            // }
        }
        if($files = $request->file('education_document4')) {
            // foreach($request->file('files') as $key => $file) {
                $uploadFile =sha1(time().rand()).'.'.$files->getClientOriginalExtension();
              //  $destinationPath = $file->storeAs('profile/tutor/documnets/'.$request->register_id, $uploadFile);
                $files->move('tutor/docs/'.$request->register_id, $uploadFile);
                $profile->education_document4 = $uploadFile;
            // }
        }
        if($files = $request->file('education_document2')) {
            // foreach($request->file('files') as $key => $file) {
                $uploadFile =sha1(time().rand()).'.'.$files->getClientOriginalExtension();
              //  $destinationPath = $file->storeAs('profile/tutor/documnets/'.$request->register_id, $uploadFile);
                $files->move('tutor/docs/'.$request->register_id, $uploadFile);
                $profile->education_document2 = $uploadFile;
            // }
        }
        if($files = $request->file('education_document3')) {
            // foreach($request->file('files') as $key => $file) {
                $uploadFile =sha1(time().rand()).'.'.$files->getClientOriginalExtension();
              //  $destinationPath = $file->storeAs('profile/tutor/documnets/'.$request->register_id, $uploadFile);
                $files->move('tutor/docs/'.$request->register_id, $uploadFile);
                $profile->education_document3 = $uploadFile;
            // }
        }



        return response()->json([
            'profile' => $profile,
            'status' => 200,
        ]);
    }

    public function getProfile() {

        $user = auth()->user();

        if ($user) {
            $profile = TeacherProfile::where('teacher_id', $user->id)->latest()->first();
            if($profile) {
                $profile->teacher = Teacher::where('id', $profile->teacher_id)->first();

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


            }


            else {
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
