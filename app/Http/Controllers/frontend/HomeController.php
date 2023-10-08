<?php

namespace App\Http\Controllers\frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function homepage()
    {
        $sliders = Slider::where('is_active', 1)->select('id', 'slider_heading', 'slider_details', 'slider_image')->latest('id')->limit(6)->get();

        return view('frontend.pages.home', compact(
            'sliders',
        ));
    }
}
