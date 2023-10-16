<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelImage;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function hotelPage()
    {
        $all_hotels = Hotel::where('is_active', 1)->select('id', 'hotel_name', 'hotel_image', 'hotel_location', 'hotel_details', 'hotel_rating', 'room_type', 'room_price')->latest('id')->get();

        $locations = Hotel::where('is_active', 1)
            ->select('hotel_location')
            ->distinct()
            ->orderBy('hotel_location', 'asc')
            ->get();
        return view('frontend.pages.hotel', compact('all_hotels','locations'));
    }

    public function hotelsearch(Request $request){
        $validation = $request->validate([
            'location' => 'required|string',
        ]);

        $location = $request->input('location');

        $hotels = Hotel::where('is_active', 1)
            ->where('hotel_location', $location)
            ->get();

            $locations = Hotel::where('is_active', 1)
            ->select('hotel_location')
            ->distinct()
            ->orderBy('hotel_location', 'asc')
            ->get();
        return view('frontend.pages.hotel', compact('hotels', 'locations'));
    }

    public function detail($id){
        $hotel = Hotel::where('id', $id)->select('id', 'hotel_name', 'hotel_image', 'hotel_location', 'hotel_details', 'hotel_rating', 'room_type', 'room_price')->first();
        $images = HotelImage::where('hotel_id', $id)->get();
        return view('frontend.pages.hotel_details',compact('hotel','images'));
    }
}
