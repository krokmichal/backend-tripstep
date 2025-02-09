<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class ChangePasswordController extends Controller
{
    /**
     * Aktualizacja hasła dla zalogowanego użytkownika
     */
    public function update(Request $request)
    {
        Log::info('Żądanie zmiany hasła otrzymane', ['data' => $request->all()]);
        // Walidacja danych wejściowych
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        // Sprawdzenie poprawności aktualnego hasła
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Podane hasło jest nieprawidłowe.'],
            ]);
        }

        // Zmiana hasła i zapis do bazy danych
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Hasło zostało zmienione pomyślnie.']);
    }
}
