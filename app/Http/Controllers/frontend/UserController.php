<?php

namespace App\Http\Controllers\frontend;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profilepage()
    {
        return view('frontend.pages.user.profile');
    }

    public function changeImage(Request $request)
    {
        $validation = $request->validate([
            'image' => 'required|mimes:png,jpg|max:10240'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([]);
        $this->image_upload($request, $user->id);
        Toastr::success('Profile image has been updated');
        return back();
    }


    public function image_upload($request, $user_id)
    {
        $user = User::findorFail($user_id);

        if ($request->hasFile('image')) {
            if ($user->image != 'default_user.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/user/';
                $old_photo_location = $photo_location . $user->image;
                unlink(base_path($old_photo_location));
            }
            $photo_loation = 'public/uploads/user/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = time() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(512, 512)->save(base_path($new_photo_location));
            $check = $user->update([
                'image' => $new_photo_name,
            ]);
        }
    }


    public function editProfile(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        Toastr::success('Your Profile has been updated');
        return back();
    }



    public function changePasswordPage()
    {
        return view('frontend.pages.user.change_password');
    }



    public function changePassword(Request $request)
    {
        $validation = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|same:retype_password|min:6',
        ]);

        $current_user_password = Hash::check($request->old_password, auth()->user()->password);

        if ($current_user_password) {
            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            Auth::logout();
            Toastr::success('Password updated successfully');
            return redirect()->route('homepage');
        } else {
            Toastr::error('Current password does not match with old password');
            return back();
        }
    }
}
