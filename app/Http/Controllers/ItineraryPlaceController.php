<?php

namespace App\Http\Controllers;

use App\Models\ItineraryPlace;
use Illuminate\Http\Request;

class ItineraryPlaceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'itinerary_day_id' => 'required|exists:itinerary_days,id',
            'place_id' => 'nullable|exists:places_to_visit,id',
            'name' => 'required|string',
            'address' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'phone_number' => 'nullable|string',
            'website' => 'nullable|string',
        ]);

        $place = ItineraryPlace::create($validated);

        return response()->json([
            'message' => 'Place added successfully',
            'place' => $place,
        ], 201);
    }

    public function destroy($id)
    {
        $place = ItineraryPlace::findOrFail($id);
        $place->delete();

        return response()->json(['message' => 'Place deleted successfully']);
    }
}
