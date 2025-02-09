<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TripController;
use App\Http\Controllers\PlaceToVisitController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\ItineraryNoteController;
use App\Http\Controllers\ItineraryChecklistController;
use App\Http\Controllers\ItineraryItemController;
use App\Http\Controllers\ItineraryPlaceController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/trips', [TripController::class, 'index']);
    Route::post('/trips', [TripController::class, 'store']);
    Route::put('/trips/{trip}', [TripController::class, 'update']);
    Route::delete('/trips/{trip}', [TripController::class, 'destroy']);
    Route::get('/trips/{id}', [TripController::class, 'show']);

    Route::post('/places-to-visit', [PlaceToVisitController::class, 'store']);
    Route::get('/places-to-visit', [PlaceToVisitController::class, 'index']);
    Route::delete('/places-to-visit/{id}', [PlaceToVisitController::class, 'destroy']);
    Route::patch('/places-to-visit/{id}', [PlaceToVisitController::class, 'update']);

    Route::post('/hotels', [HotelController::class, 'store']);
    Route::get('/hotels', [HotelController::class, 'index']);
    Route::delete('/hotels/{id}', [HotelController::class, 'destroy']);

    Route::post('/itineraries', [ItineraryController::class, 'store']);
    Route::post('/itinerary-notes', [ItineraryController::class, 'storeNote']);
    Route::post('/itinerary-checklists', [ItineraryController::class, 'storeChecklist']);
    Route::get('/itineraries', [ItineraryController::class, 'fetchItinerary']);
    Route::patch('/itineraries/{id}', [ItineraryController::class, 'updateDates']);
    Route::patch('/itinerary-notes/{id}', [ItineraryNoteController::class, 'update']);
    Route::patch('/itinerary-checklists/{id}', [ItineraryChecklistController::class, 'update']);
    Route::patch('/itinerary-items/reorder', [ItineraryItemController::class, 'reorder']);
    Route::post('/itinerary-items/update-order', [ItineraryItemController::class, 'updateOrder']);

    Route::get('/budgets/{trip}', [BudgetController::class, 'show']);
    Route::post('/budgets', [BudgetController::class, 'store']);
    Route::put('/budgets/{tripId}', [BudgetController::class, 'update']);
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);

    Route::post('/flights', [FlightController::class, 'store']);
    Route::delete('/flights/{id}', [FlightController::class, 'destroy']);
    Route::get('/flights', [FlightController::class, 'index']);

    Route::post('/itinerary-places', [ItineraryPlaceController::class, 'store']);
    Route::get('/itinerary-places/{trip_id}', [ItineraryPlaceController::class, 'getPlacesByTrip']);
    
    Route::post('/change-password', [ChangePasswordController::class, 'update']);
    
    Route::delete('/delete-account', [AuthController::class, 'deleteAccount']);
});


Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});





