<?php

namespace App\Http\Controllers\backend;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\FlightCreateRequest;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('flight-list');
        $flights = Flight::select('id','airlines_name', 'airlines_model', 'departure_time', 'from', 'to', 'total_sit', 'available_sit', 'price', 'flight_date', 'is_active')->latest('id')->get();
        return view('backend.pages.flight.index', compact('flights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('flight-create');
        return view('backend.pages.flight.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlightCreateRequest $request)
    {
        Gate::authorize('flight-create');
        Flight::create([
            "airlines_name" => $request->airlines_name,
            "airlines_model" => $request->airlines_model,
            "departure_time" => $request->departure_time,
            "from" => $request->from,
            "to" => $request->to,
            "total_sit" => $request->total_sit,
            "available_sit" => $request->available_sit,
            "price" => $request->price,
            "flight_date" => $request->flight_date,
        ]);
        Toastr::success('Flight added successfully');
        return redirect()->route('flight.index');
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
        Gate::authorize('flight-edit');
        $flight = Flight::findOrFail($id);
        return view('backend.pages.flight.edit', compact('flight'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FlightCreateRequest $request, string $id)
    {
        Gate::authorize('flight-edit');
        $flight = Flight::findOrFail($id);
        $flight->update([
            "airlines_name" => $request->airlines_name,
            "airlines_model" => $request->airlines_model,
            "departure_time" => $request->departure_time,
            "from" => $request->from,
            "to" => $request->to,
            "total_sit" => $request->total_sit,
            "available_sit" => $request->available_sit,
            "price" => $request->price,
            "flight_date" => $request->flight_date,
        ]);
        Toastr::success('Flight updated successfully');
        return redirect()->route('flight.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('flight-delete');
        $flight = Flight::findOrFail($id);
        $flight->delete();
        Toastr::success('Flight deleted successfully');
        return redirect()->route('flight.index');
    }


    public function changeStatus(string $id)
    {
        $flight = Flight::find($id);
        if ($flight->is_active == 1) {
            $flight->is_active = 0;
        } else {
            $flight->is_active = 1;
        }
        $flight->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
