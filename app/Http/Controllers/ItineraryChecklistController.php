<?php

namespace App\Http\Controllers;

use App\Models\ItineraryChecklist;
use Illuminate\Http\Request;

class ItineraryChecklistController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'itinerary_day_id' => 'required|exists:itinerary_days,id',
            'content' => 'required|string',
            'completed' => 'required|boolean',
            'order' => 'required|integer',
        ]);

        $checklist = ItineraryChecklist::create($validated);

        return response()->json([
            'message' => 'Checklist item added successfully',
            'checklist' => $checklist
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'completed' => 'boolean',
        ]);

        $checklist = ItineraryChecklist::findOrFail($id);
        $checklist->update($validated);

        return response()->json([
            'message' => 'Checklist item updated successfully',
            'checklist' => $checklist
        ]);
    }

    public function destroy($id)
    {
        $checklist = ItineraryChecklist::findOrFail($id);
        $checklist->delete();

        return response()->json(['message' => 'Checklist item deleted successfully']);
    }
}
