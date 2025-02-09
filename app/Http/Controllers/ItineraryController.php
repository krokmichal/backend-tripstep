<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerary; 
use App\Models\ItineraryDay;
use App\Models\ItineraryNote;
use App\Models\ItineraryChecklist;
use App\Models\ItineraryPlace;
use Illuminate\Http\Response;
use Carbon\Carbon;

class ItineraryController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        // Tworzenie harmonogramu
        $itinerary = Itinerary::create($validatedData);
    
        // Tworzenie dni harmonogramu
        $startDate = Carbon::parse($validatedData['start_date']);
        $endDate = Carbon::parse($validatedData['end_date']);
        $days = [];
    
        while ($startDate <= $endDate) {
            $days[] = $itinerary->days()->create(['date' => $startDate->toDateString()]);
            $startDate->addDay();
        }
    
        return response()->json([
            'itinerary' => $itinerary,
            'days' => $days,
        ], 201);
    }
    

    public function storeNote(Request $request)
    {
        $validated = $request->validate([
            'itinerary_day_id' => 'required|exists:itinerary_days,id',
            'content' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
        ]);
    
        $note = ItineraryNote::create($validated);
    
        return response()->json($note, 201);
    }
    



public function storeChecklist(Request $request)
{
    $validated = $request->validate([
        'itinerary_day_id' => 'required|exists:itinerary_days,id',
        'content' => 'nullable|string|max:255',
        'completed' => 'required|boolean',
        'order' => 'required|integer',
    ]);

    $checklist = ItineraryChecklist::create($validated);

    return response()->json($checklist, 201);
}

public function fetchItinerary(Request $request)
{
    $tripId = $request->query('trip_id');

    $itinerary = Itinerary::where('trip_id', $tripId)->first();

    if (!$itinerary) {
        return response()->json([
            'message' => 'No itinerary found for this trip.',
        ], 404);
    }

    // Pobranie dni harmonogramu z notatkami, checklistami i miejscami
    $days = ItineraryDay::where('itinerary_id', $itinerary->id)
            ->with([
                'notes' => function ($query) {
                    $query->orderBy('order', 'asc');
                },
                'checklists' => function ($query) {
                    $query->orderBy('order', 'asc');
                },
                'places' => function ($query) {
    $query->orderBy('order', 'asc');
},

            ])
            ->orderBy('date', 'asc')
            ->get();

    return response()->json([
        'itinerary' => $itinerary,
        'days' => $days,
    ]);
}



public function updateDates(Request $request, $id)
{
    $validated = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $itinerary = Itinerary::findOrFail($id);

    // Aktualizacja dat w harmonogramie
    $itinerary->start_date = $validated['start_date'];
    $itinerary->end_date = $validated['end_date'];
    $itinerary->save();

    // Usuwanie istniejących dni
    $itinerary->days()->delete();

    // Tworzenie nowych dni
    $currentDate = Carbon::parse($validated['start_date']);
    $endDate = Carbon::parse($validated['end_date']);

    while ($currentDate <= $endDate) {
        $itinerary->days()->create([
            'date' => $currentDate->toDateString(),
        ]);
        $currentDate->addDay();
    }

    return response()->json(['message' => 'Itinerary dates updated successfully.']);
}

public function updateItemOrder(Request $request)
{
    $validated = $request->validate([
        'items' => 'required|array',
        'items.*.id' => 'required|integer',
        'items.*.order' => 'required|integer|min:1',
        'items.*.type' => 'required|string|in:note,checklist',
    ]);

    foreach ($validated['items'] as $item) {
        if ($item['type'] === 'note') {
            ItineraryNote::where('id', $item['id'])->update(['order' => $item['order']]);
        } elseif ($item['type'] === 'checklist') {
            ItineraryChecklist::where('id', $item['id'])->update(['order' => $item['order']]);
        }
    }

    return response()->json(['message' => 'Order updated successfully']);
}





}