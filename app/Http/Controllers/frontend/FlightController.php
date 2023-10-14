<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function flightPage()
    {
        $flightFrom = Flight::where('is_active', 1)
            ->select('from')
            ->distinct()
            ->orderBy('from', 'asc')
            ->get();

        return view('frontend.pages.flight', compact('flightFrom'));
    }



    public function getToData(Request $request)
    {
        $from = $request->input('from');
        $flightsTo = Flight::where('from', $from)->select('to')
            ->distinct()
            ->orderBy('from', 'asc')
            ->get();

        return response()->json($flightsTo);
    }


    public function flightsearch(Request $request)
    {
        $validation = $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'flight_date' => 'required|date',
        ]);
        $from = $request->input('from');
        $to = $request->input('to');
        $flight_date = $request->input('flight_date');

        $flights = Flight::where('is_active', 1)
            ->where('from', $from)
            ->where('to', $to)
            ->whereDate('flight_date', $flight_date)
            ->get();

        $flightFrom = Flight::where('is_active', 1)
            ->select('from')
            ->distinct()
            ->orderBy('from', 'asc')
            ->get();
        return view('frontend.pages.flight', compact('flights', 'flightFrom'));
    }
}
