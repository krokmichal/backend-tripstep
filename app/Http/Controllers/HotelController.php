<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Http\Response;

class HotelController extends Controller {
    public function store(Request $request) {
        \Log::info('Received hotel data:', $request->all()); // Loguj wszystkie dane przychodzące z frontendu
    
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'title' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'price' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'book_url' => 'nullable|string'
        ]);
    
        \Log::info('Validated hotel data:', $validated); // Loguj dane po walidacji
    
        $hotel = Hotel::create($validated);
    
        \Log::info('Hotel saved to database:', $hotel->toArray()); // Loguj dane zapisane w bazie
    
        return response()->json($hotel, 201);
    }
    

    public function index(Request $request) {
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
        ]);
    
        $hotels = Hotel::where('trip_id', $validated['trip_id'])->get();
    
        return response()->json($hotels);
    }

    public function destroy($id) {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
    
        return response()->json(['message' => 'Hotel deleted successfully.'], 200);
    }
    
    
}
