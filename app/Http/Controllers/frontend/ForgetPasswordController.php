<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{

    public function forgetPasswordPage()
    {
        return view('frontend.pages.forget_password.forget_password');
    }


    public function forgetPassword(Request $request)
    {
        $validate = $request->validate([
            'email' => "required|email|exists:users",
        ]);

        $token = Str::random(64);

        PasswordResetToken::create([
            'email' => $request->email,
            'token' => $token,
        ]);

        Mail::to($request->email)->send(
            new ResetPasswordMail($token)
        );

        Toastr::success('A reset password link send to your mail.');
        return back();
    }


    public function resetPasswordPage($token){
        return view('frontend.pages.forget_password.reset_password',compact('token'));
    }


    public function resetPassword(Request $request){

        $validate = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $checkinfo = PasswordResetToken::where('email', $request->email)->where('token', $request->token)->first();
        if (!$checkinfo) {
            Toastr::error('An error occour when reset your password');
            return back();
        }

        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        $checkinfo->delete();
        Toastr::success('Password Reset Successfully');
        return redirect()->route('homepage');
    }
}
