<?php

namespace App\Http\Controllers\backend;

use Image;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\HotelStoreRequest;
use App\Http\Requests\HotelUpdateRequest;
use App\Models\HotelImage;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('hotel-list');
        $hotels = Hotel::select('id', 'hotel_name', 'hotel_image', 'hotel_location', 'hotel_rating', 'room_type', 'room_price', 'is_active', 'created_at')->latest('id')->get();
        return view('backend.pages.hotel.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('hotel-create');
        return view('backend.pages.hotel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelStoreRequest $request)
    {
        Gate::authorize('hotel-create');
        $hotel = Hotel::create([
            "hotel_name" => $request->hotel_name,
            "hotel_location" => $request->hotel_location,
            "room_price" => $request->room_price,
            "hotel_rating" => $request->hotel_rating,
            "room_type" => $request->room_type,
            "hotel_details" => $request->hotel_details,
        ]);

        $this->image_upload($request, $hotel->id);
        $this->multiple_image_upload($request, $hotel->id);
        Toastr::success('Hotel store successfully');
        return redirect()->route('hotel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('hotel-view');
        $hotels = Hotel::select('id', 'hotel_name', 'hotel_image', 'hotel_location', 'hotel_rating', 'hotel_details', 'room_type', 'room_price', 'is_active', 'created_at')->first();

        $images = HotelImage::where('hotel_id', $id)->get();
        return view('backend.pages.hotel.view', compact('hotels', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('hotel-edit');
        $hotel = Hotel::findOrFail($id);
        return view('backend.pages.hotel.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelUpdateRequest $request, string $id)
    {
        Gate::authorize('hotel-edit');
        $hotel = Hotel::findOrFail($id);
        $hotel->update([
            "hotel_name" => $request->hotel_name,
            "hotel_location" => $request->hotel_location,
            "room_price" => $request->room_price,
            "hotel_rating" => $request->hotel_rating,
            "room_type" => $request->room_type,
            "hotel_details" => $request->hotel_details,
        ]);
        $this->image_upload($request, $hotel->id);
        $this->multiple_image_upload($request, $hotel->id);
        Toastr::success('Hotel update successfully');
        return redirect()->route('hotel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('hotel-delete');
        $hotel = Hotel::findOrFail($id);
        if ($hotel->hotel_image != 'default_hotel.jpg') {
            //delete old photo
            $photo_location = 'public/uploads/hotel/';
            $old_photo_location = $photo_location . $hotel->hotel_image;
            unlink(base_path($old_photo_location));
        }
        $multiple_images = HotelImage::where('hotel_id', $id)->get();
        foreach ($multiple_images as $multiple_image) {
            if ($multiple_image->package_multiple_image != 'default_hotel.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/hotel/';
                $old_photo_location = $photo_location . $multiple_image->hotel_multiple_image;
                unlink(base_path($old_photo_location));
            }
            //delete old value of db table
            $multiple_image->delete();
        }

        $hotel->delete();
        Toastr::success('Hotel deleted successfully');
        return back();
    }


    public function image_upload($request, $hotel_id)
    {
        $hotel = Hotel::findorFail($hotel_id);

        if ($request->hasFile('hotel_image')) {
            if ($hotel->hotel_image != 'default_hotel.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/hotel/';
                $old_photo_location = $photo_location . $hotel->hotel_image;
                unlink(base_path($old_photo_location));
            }

            $photo_loation = 'public/uploads/hotel/';
            $uploaded_photo = $request->file('hotel_image');
            $new_photo_name = $hotel->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(780, 420)->save(base_path($new_photo_location));
            $check = $hotel->update([
                'hotel_image' => $new_photo_name,
            ]);
        }
    }



    public function multiple_image_upload($request, $hotel_id)
    {
        if ($request->hasFile('hotel_multiple_image')) {
            //delete old photo first
            $multiple_images = HotelImage::where('hotel_id', $hotel_id)->get();
            foreach ($multiple_images as $multiple_image) {
                if ($multiple_image->hotel_multiple_image != 'default_hotel.jpg') {
                    //delete old photo
                    $photo_location = 'public/uploads/hotel/';
                    $old_photo_location = $photo_location . $multiple_image->hotel_multiple_image;
                    unlink(base_path($old_photo_location));
                }
                //delete old value of db table
                $multiple_image->delete();
            }
            $flag = 1;
            foreach ($request->file('hotel_multiple_image') as $single_photo) {
                $photo_loation = 'public/uploads/hotel/';
                $new_photo_name = $hotel_id . '-' . $flag . '.' . $single_photo->getClientOriginalExtension();
                $new_photo_location = $photo_loation . $new_photo_name;
                Image::make($single_photo)->resize(200, 200)->save(base_path($new_photo_location));
                HotelImage::create([
                    'hotel_id' => $hotel_id,
                    'hotel_multiple_image' => $new_photo_name,
                ]);
                $flag++;
            }
        }
    }

    public function changeStatus(string $id)
    {
        $hotel = Hotel::find($id);
        if ($hotel->is_active == 1) {
            $hotel->is_active = 0;
        } else {
            $hotel->is_active = 1;
        }
        $hotel->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
