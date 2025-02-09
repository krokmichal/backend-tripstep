<?php

namespace App\Http\Controllers;
use App\Models\PlaceToVisit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaceToVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tripId = $request->query('trip_id'); // Pobierz trip_id z zapytania
    
        if (!$tripId) {
            return response()->json(['message' => 'trip_id is required'], 400);
        }
    
        $places = PlaceToVisit::where('trip_id', $tripId)
        ->orderBy('order', 'asc') // Sortowanie według kolejności
        ->get();
    
        return response()->json($places);
    }
    



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'trip_id' => 'required|integer',
            'place_id' => 'required|string',
            'name' => 'required|string',
            'address' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'phone_number' => 'nullable|string',
            'website' => 'nullable|url'
        ]);

        $place = PlaceToVisit::create($data);
        return response()->json($place, 201);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $place = PlaceToVisit::find($id);

    if (!$place) {
        return response()->json(['message' => 'Place not found.'], Response::HTTP_NOT_FOUND);
    }

    // Walidacja danych
    $validated = $request->validate([
        'is_favorite' => 'boolean', // Laravel sam konwertuje wartości na boolean
        'order' => 'integer|min:0',
    ]);

    // Aktualizacja w bazie
    $place->update($validated);

    return response()->json(['message' => 'Place updated successfully.'], Response::HTTP_OK);
}

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $place = PlaceToVisit::find($id);

        if (!$place) {
            return response()->json(['message' => 'Place not found.'], Response::HTTP_NOT_FOUND);
        }

        $place->delete();

        return response()->json(['message' => 'Place deleted successfully.'], Response::HTTP_OK);
    }
}
