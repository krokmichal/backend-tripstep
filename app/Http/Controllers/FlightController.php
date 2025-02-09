<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Http\Response;

class FlightController extends Controller
{
    public function store(Request $request)
    {
        


        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'title' => 'required|string|max:255',
            'departure_airport_first' => 'required|string|max:255',
            'arrival_airport_first' => 'required|string|max:255',
            'departure_date_first' => 'required|date',
            'arrival_date_first' => 'required|date',
            'departure_airport_second' => 'nullable|string|max:255',
            'arrival_airport_second' => 'nullable|string|max:255',
            'departure_date_second' => 'nullable|date',
            'arrival_date_second' => 'nullable|date',
            'price' => 'required|numeric|min:0',
            'flight_duration_first' => 'required|integer|min:0',
            'flight_duration_second' => 'nullable|integer|min:0',
            'sky_scanner_url' => 'nullable|string|max:500',
        ]);

        $flight = Flight::create($validated);

        return response()->json($flight, 201);
    }

    public function index(Request $request) {
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
        ]);
    
        $flights = Flight::where('trip_id', $validated['trip_id'])->get();
    
        return response()->json($flights);
    }

    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();

        return response()->json(['message' => 'Flight deleted successfully'], 200);
    }
}
