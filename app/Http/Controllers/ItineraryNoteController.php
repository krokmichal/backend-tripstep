<?php

namespace App\Http\Controllers;

use App\Models\ItineraryNote;
use Illuminate\Http\Request;

class ItineraryNoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'itinerary_day_id' => 'required|exists:itinerary_days,id',
            'content' => 'required|string',
            'order' => 'required|integer',
        ]);

        $note = ItineraryNote::create($validated);

        return response()->json([
            'message' => 'Note added successfully',
            'note' => $note
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $note = ItineraryNote::findOrFail($id);
        $note->update($validated);

        return response()->json([
            'message' => 'Note updated successfully',
            'note' => $note
        ]);
    }

    public function destroy($id)
    {
        $note = ItineraryNote::findOrFail($id);
        $note->delete();

        return response()->json(['message' => 'Note deleted successfully']);
    }
}
