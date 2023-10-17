<?php

namespace App\Http\Controllers\frontend\auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class RegistrationController extends Controller
{

    public function registration(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255",
            "phone" => "required|numeric",
            "address" => "required|string|max:255",
            "password" => "required|string|confirmed",
        ]);
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "role_id" => 3,
            'password' => Hash::make($request->password),
        ]);
        Toastr::success('Registration successfully');
        return back();
    }



    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }



    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // dd($user);
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                "name" => $user->name,
                "email" => $user->email,
                "phone" => $user->phone,
                "address" => $user->address,
                "role_id" => 3,
                'password' => Hash::make('password'),
            ]);
            Auth::login($newUser);
        }
        return redirect()->route('profilepage');
    }
}
