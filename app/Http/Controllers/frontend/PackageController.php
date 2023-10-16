<?php

namespace App\Http\Controllers\frontend;

use App\Models\Package;
use App\Models\Category;
use App\Models\PackageImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
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
