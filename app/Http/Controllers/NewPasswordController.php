<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;

use App\Mail\SendCodeResetPassword;
use Illuminate\Support\Facades\Mail;

use App\Models\Student;
use App\Models\Teacher;

class NewPasswordController extends Controller
{
    public function submitForgetPasswordForm(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'email' => 'required|email',
        ]);

        $token = Str::random(64);
        $teacher = Teacher::where('email', $request->email)->first();
        $student = Student::where('email', $request->email)->first();

        if ($teacher || $student) {
            $tokenEntry = \DB::table('password_reset_tokens')->where('email', $request->email)->first();

            if (!$tokenEntry) {
                // Insert the token and email into the password_reset_tokens table
                \DB::table('password_reset_tokens')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }

            Mail::to($request->email)->send(new SendCodeResetPassword($token));

            return response(['msg' => trans('passwords.sent')], 200);
        } else {
            return response(['msg' => 'Email not found in the database.'], 404);
        }
    }

    public function showResetPasswordForm($token) {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
      {
        //   $request->validate([
        //       'email' => 'required|email',
        //       'password' => 'required|string|min:6|confirmed',
        //       'password_confirmation' => 'required',
        //       'user_type' => 'required',
        //   ]);

          $updatePassword = DB::table('password_reset_tokens')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();
                             // dd($updatePassword);

          if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
          }

          //dd($request->all());

          if($request->user_type == 'students') {
            $student = Student::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
          } elseif ($request->user_type == 'teachers') {
            $teacher = Teacher::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
          }



          DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();


          return back()->with('message', 'Your password has been changed! <a href="http://localhost:5173/login">Go to Login Page</a>');
      }


}
