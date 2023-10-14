<?php

namespace App\Http\Controllers\frontend;

use App\Models\Slider;
use App\Models\Contact;
use App\Models\Package;
use App\Models\Category;
use App\Models\PackageImage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\ContactStoreRequest;

class HomeController extends Controller
{

    public function homepage()
    {
        $sliders = Slider::where('is_active', 1)->select('id', 'slider_heading', 'slider_details', 'slider_image')->latest('id')->limit(6)->get();
        $topPackage = Package::where('is_active', 1)->select('id', 'package_name', 'package_image', 'package_rating')->latest('package_rating')->limit(6)->get();
        $latest_package = Package::where('is_active', 1)->select('id','package_name','package_price', 'package_image')->latest('id')->limit(12)->get();


        return view('frontend.pages.home', compact(
            'sliders',
            'topPackage',
            'latest_package'
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


    public function package()
    {
        $categories = Category::with('package')->where('is_active', 1)->select('id', 'category_name')->get();
        $all_package = Package::where('is_active', 1)->select('id', 'category_id', 'package_name', 'package_period', 'package_price', 'package_image', 'package_details', 'start_from', 'package_rating', 'starting_date', 'ending_date')->latest('id')->get();
        return view('frontend.pages.package', compact('all_package', 'categories'));
    }


    public function detail($id){
        $package = Package::with('category:id,category_name')->where('id', $id)->select('id', 'package_name','start_from', 'package_period', 'package_price', 'package_image', 'package_details', 'package_rating', 'starting_date', 'ending_date', 'is_active',  'category_id',  'created_at')->first();
        $images = PackageImage::where('package_id', $id)->get();
        return view('frontend.pages.package_details',compact('package','images'));
    }

}
