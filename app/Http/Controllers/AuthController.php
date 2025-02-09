<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Nie znaleziono użytkownika.'], 404);
        }

        // Sprawdzenie poprawności hasła
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Nieprawidłowe hasło.'], 403);
        }

        DB::transaction(function () use ($user) {
            // Pobieramy ID tripów użytkownika
            $tripIds = DB::table('trips')->where('user_id', $user->id)->pluck('id');

            if ($tripIds->isNotEmpty()) {
                // Usuwanie powiązanych danych
                DB::table('flights')->whereIn('trip_id', $tripIds)->delete();
                DB::table('hotels')->whereIn('trip_id', $tripIds)->delete();
                DB::table('itineraries')->whereIn('trip_id', $tripIds)->delete();
                DB::table('places_to_visit')->whereIn('trip_id', $tripIds)->delete();
                DB::table('budgets')->whereIn('trip_id', $tripIds)->delete();
                
                // Usuwanie tripów
                DB::table('trips')->whereIn('id', $tripIds)->delete();
            }

            // Usuwanie użytkownika
            $user->delete();
        });

        return response()->json(['message' => 'Konto zostało usunięte.'], 200);
    }
}
