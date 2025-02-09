<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Trip;


class BudgetController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'limit' => 'required|numeric|min:0',
        ]);
    
        $budget = Budget::create($validated);
    
        return response()->json($budget, 201);
    }

    public function update(Request $request, $tripId)
    {
        $validated = $request->validate([
            'limit' => 'required|numeric|min:0',
        ]);
    
        // Znajdź budżet powiązany z tripId
        $budget = Budget::where('trip_id', $tripId)->first();
    
        if (!$budget) {
            return response()->json(['error' => 'Budget not found for this trip'], 404);
        }
    
        // Zaktualizuj limit budżetu
        $budget->update($validated);
    
        return response()->json($budget);
    }
    
    




    

public function destroy($id)
{
    $expense = Expense::findOrFail($id);
    $expense->delete();

    return response()->json(['message' => 'Expense deleted'], 200);
}

public function show($tripId)
{
    $budget = Budget::where('trip_id', $tripId)->with('expenses')->first();

    if (!$budget) {
        return response()->json(['message' => 'Budget not found'], 404);
    }

    return response()->json($budget);
}


}
