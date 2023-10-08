<?php

namespace App\Http\Controllers\backend;

use Image;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('slider-list');
        $sliders = Slider::select('id', 'slider_heading', 'slider_details', 'slider_image', 'is_active', 'created_at')->latest('id')->get();
        return view('backend.pages.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('slider-create');
        return view('backend.pages.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderStoreRequest $request)
    {
        Gate::authorize('slider-create');
        $slider = Slider::Create([
            "slider_heading" => $request->slider_heading,
            "slider_details" => $request->slider_details,
        ]);
        $this->image_upload($request, $slider->id);
        Toastr::success('slider created successfully');
        return redirect()->route('slider.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('slider-edit');
        $slider = Slider::findOrFail($id);
        return view('backend.pages.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, string $id)
    {
        Gate::authorize('slider-edit');
        $slider = Slider::findOrFail($id);
        $slider->update([
            "slider_heading" => $request->slider_heading,
            "slider_details" => $request->slider_details,
        ]);
        $this->image_upload($request, $slider->id);
        Toastr::success('slider updated successfully');
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('slider-delete');
        $slider = Slider::findOrFail($id);
        if ($slider->slider_image != 'default_slider.jpg') {
            //delete old photo
            $photo_location = 'public/uploads/slider/';
            $old_photo_location = $photo_location . $slider->slider_image;
            unlink(base_path($old_photo_location));
        }
        $slider->delete();
        Toastr::success('slider updated successfully');
        return redirect()->route('slider.index');
    }



    public function image_upload($request, $slider_id)
    {
        $slider = Slider::findorFail($slider_id);

        if ($request->hasFile('slider_image')) {
            $photo_loation = 'public/uploads/slider/';
            $uploaded_photo = $request->file('slider_image');
            $new_photo_name = time() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(1600, 600)->save(base_path($new_photo_location));
            $check = $slider->update([
                'slider_image' => $new_photo_name,
            ]);
        }
    }

    public function changeStatus(string $id)
    {
        $slider = Slider::find($id);
        if ($slider->is_active == 1) {
            $slider->is_active = 0;
        } else {
            $slider->is_active = 1;
        }
        $slider->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
