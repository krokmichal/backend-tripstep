<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;


class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'budget_id' => 'required|exists:budgets,id',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);
    
        $expense = Expense::create($validated);
    
        return response()->json($expense, 201);
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'amount' => 'required|numeric|min:0',
        'category' => 'required|string|max:255',
    ]);

    $expense = Expense::findOrFail($id);
    $expense->update($validated);

    return response()->json($expense);
}

public function destroy($id)
{
    $expense = Expense::findOrFail($id); // Znajdź wydatek lub zwróć 404
    $expense->delete(); // Usuń wydatek

    return response()->json(['message' => 'Expense deleted'], 200);
}

    

}
