<?php

namespace App\Http\Controllers\backend;

use Image;
use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PackageStoreRequest;
use App\Http\Requests\PackageUpdateRequest;
use App\Models\PackageImage;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('package-list');
        $packages = Package::select('id', 'category_id', 'package_name', 'package_period', 'start_from','package_price', 'package_image', 'package_details', 'package_rating', 'starting_date', 'ending_date', 'is_active', 'created_at')->latest('id')->get();
        return view('backend.pages.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('package-create');
        $category = Category::where('is_active', 1)->select('id', 'category_name')->latest('id')->get();
        return view('backend.pages.package.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageStoreRequest $request)
    {
        Gate::authorize('package-create');

        $package = Package::create([
            "category_id" => $request->category_id,
            "package_name" => $request->package_name,
            "package_period" => $request->package_period,
            "package_price" => $request->package_price,
            "package_rating" => $request->package_rating,
            "starting_date" => $request->starting_date,
            "ending_date" => $request->ending_date,
            "start_from"=>$request->start_from,
            "package_details" => $request->package_details,
        ]);

        $this->image_upload($request, $package->id);
        $this->multiple_image_upload($request, $package->id);
        Toastr::success('Package store successfully');
        return redirect()->route('package.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('package-view');
        $packages = Package::with('category:id,category_name')->where('id', $id)->select('id', 'package_name','start_from', 'package_period', 'package_price', 'package_image', 'package_details', 'package_rating', 'starting_date', 'ending_date', 'is_active',  'category_id',  'created_at')->latest('id')->first();
        $images = PackageImage::where('package_id', $id)->get();
        return view('backend.pages.package.view', compact('packages', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('package-edit');
        $category = Category::where('is_active', 1)->select('id', 'category_name')->latest('id')->get();
        $package = Package::findOrFail($id);
        return view('backend.pages.package.edit', compact('package', 'category'));;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageUpdateRequest $request, string $id)
    {
        Gate::authorize('package-edit');

        $package = Package::findOrFail($id);
        $package->update([
            "category_id" => $request->category_id,
            "package_name" => $request->package_name,
            "package_period" => $request->package_period,
            "package_price" => $request->package_price,
            "package_rating" => $request->package_rating,
            "starting_date" => $request->starting_date,
            "ending_date" => $request->ending_date,
            "start_from"=>$request->start_from,
            "package_details" => $request->package_details,
        ]);

        $this->image_upload($request, $package->id);
        $this->multiple_image_upload($request, $package->id);
        Toastr::success('Package updated successfully');
        return redirect()->route('package.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('package-delete');
        $package = Package::findOrFail($id);
        if ($package->package_image != 'default_package.jpg') {
            //delete old photo
            $photo_location = 'public/uploads/package/';
            $old_photo_location = $photo_location . $package->package_image;
            unlink(base_path($old_photo_location));
        }
        $multiple_images = PackageImage::where('package_id', $id)->get();
        foreach ($multiple_images as $multiple_image) {
            if ($multiple_image->package_multiple_image != 'default_package.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/package/';
                $old_photo_location = $photo_location . $multiple_image->package_multiple_image;
                unlink(base_path($old_photo_location));
            }
            //delete old value of db table
            $multiple_image->delete();
        }

        $package->delete();
        Toastr::success('Package deleted successfully');
        return back();
    }



    public function image_upload($request, $package_id)
    {
        $package = Package::findorFail($package_id);

        if ($request->hasFile('package_image')) {
            if ($package->package_image != 'default_package.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/package/';
                $old_photo_location = $photo_location . $package->package_image;
                unlink(base_path($old_photo_location));
            }

            $photo_loation = 'public/uploads/package/';
            $uploaded_photo = $request->file('package_image');
            $new_photo_name = $package->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_loation . $new_photo_name;
            Image::make($uploaded_photo)->resize(780, 420)->save(base_path($new_photo_location));
            $check = $package->update([
                'package_image' => $new_photo_name,
            ]);
        }
    }



    public function multiple_image_upload($request, $package_id)
    {
        if ($request->hasFile('package_multiple_image')) {
            //delete old photo first
            $multiple_images = PackageImage::where('package_id', $package_id)->get();
            foreach ($multiple_images as $multiple_image) {
                if ($multiple_image->package_multiple_image != 'default_package.jpg') {
                    //delete old photo
                    $photo_location = 'public/uploads/package/';
                    $old_photo_location = $photo_location . $multiple_image->package_multiple_image;
                    unlink(base_path($old_photo_location));
                }
                //delete old value of db table
                $multiple_image->delete();
            }
            $flag = 1;
            foreach ($request->file('package_multiple_image') as $single_photo) {
                $photo_loation = 'public/uploads/package/';
                $new_photo_name = $package_id . '-' . $flag . '.' . $single_photo->getClientOriginalExtension();
                $new_photo_location = $photo_loation . $new_photo_name;
                Image::make($single_photo)->resize(200, 200)->save(base_path($new_photo_location));
                PackageImage::create([
                    'package_id' => $package_id,
                    'package_multiple_image' => $new_photo_name,
                ]);
                $flag++;
            }
        }
    }


    public function changeStatus(string $id)
    {
        $package = Package::find($id);
        if ($package->is_active == 1) {
            $package->is_active = 0;
        } else {
            $package->is_active = 1;
        }
        $package->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
