<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItineraryNote;
use App\Models\ItineraryChecklist;
use App\Models\ItineraryPlace; // Dodaj model dla miejsc

class ItineraryItemController extends Controller
{
    public function updateOrder(Request $request)
    {
        $items = $request->input('items');

        foreach ($items as $item) {
            if (isset($item['id'], $item['order'], $item['type'])) {
                switch ($item['type']) {
                    case 'note':
                        $note = ItineraryNote::find($item['id']);
                        if ($note) {
                            $note->order = $item['order'];
                            $note->save();
                        }
                        break;

                    case 'checklist':
                        $checklist = ItineraryChecklist::find($item['id']);
                        if ($checklist) {
                            $checklist->order = $item['order'];
                            $checklist->save();
                        }
                        break;

                    case 'place':
                        $place = ItineraryPlace::find($item['id']);
                        if ($place) {
                            $place->order = $item['order'];
                            $place->save();
                        }
                        break;
                }
            }
        }

        return response()->json(['message' => 'Order updated successfully']);
    }
}


