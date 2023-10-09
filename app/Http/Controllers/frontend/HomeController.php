<?php

namespace App\Http\Controllers\frontend;

use App\Models\Slider;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\ContactStoreRequest;

class HomeController extends Controller
{

    public function homepage()
    {
        $sliders = Slider::where('is_active', 1)->select('id', 'slider_heading', 'slider_details', 'slider_image')->latest('id')->limit(6)->get();

        return view('frontend.pages.home', compact(
            'sliders',
        ));
    }


    public function contact()
    {
        return view('frontend.pages.contact');
    }


    public function contact_post(ContactStoreRequest $request)
    {
        Contact::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "city" => $request->city,
            "message" => $request->message,
        ]);

        Toastr::success('Message sent successfully');
        return back();
    }
}
