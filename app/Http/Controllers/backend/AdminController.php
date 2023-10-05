<?php

namespace App\Http\Controllers\backend;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdateRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function changePasswordPage()
    {
        return view('backend.pages.admin.change_password');
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
            return redirect()->route('admin.loginPage');
        } else {
            Toastr::error('Current password does not match with old password');
            return back();
        }
    }


    public function profilePage()
    {
        return view('backend.pages.admin.profile');
    }


    public function changeImage(Request $request)
    {
        $validation = $request->validate([
            'image' => 'required|mimes:png,jpg|max:10240'
        ]);

        $user = User::findOrFail(Auth::user()->id)->first();
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


    public function editProfilePage()
    {
        return view('backend.pages.admin.edit_profile');
    }


    public function editProfile(AdminProfileUpdateRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        Toastr::success('Profile has been updated');
        return redirect()->route('admin.profilePage');
    }
}
