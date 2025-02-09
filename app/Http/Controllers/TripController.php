<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller {
    // Pobierz wycieczki zalogowanego użytkownika
    public function index() {
        return auth()->user()->trips;
    }

    // Utwórz nową wycieczkę
    public function store(Request $request) {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'departure_date' => 'nullable|date',
        'return_date' => 'nullable|date',
        'departure_city' => 'nullable|string|max:255',
        'arrival_city' => 'nullable|string|max:255',
        'number_of_people' => 'nullable|integer|min:1',
        'notes' => 'nullable|string',
        'budget' => 'nullable|numeric|min:0',
        ]);

        $trip = auth()->user()->trips()->create($validated);

        return response()->json($trip, 201);
    }

    // Zaktualizuj wycieczkę
    public function update(Request $request, Trip $trip) {
        // to może trzeba bd usunąć
        // $this->authorize('update', $trip);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'required|date',
            'departure_city' => 'required|string|max:255',
            'arrival_city' => 'required|string|max:255',
            'number_of_people' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
        ]);

        
        $trip->update($validated);

        return response()->json($trip);
    }
    public function destroy($id)
{
    $trip = Trip::find($id);
    

    $trip->delete();
    return response()->json($trip);
}

public function show($id)
{
    $trip = Trip::findOrFail($id); // Znajdź trip lub zwróć błąd 404
    return response()->json($trip, 200); // Zwróć dane jako JSON
}

}


