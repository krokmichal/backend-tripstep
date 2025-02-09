<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'itinerary_day_id', 
        'type', 
        'content', 
        'completed', 
        'place_id',
        'name',
        'address',
        'rating',
        'phone_number',
        'website',
        'order'
    ];

    public function day()
    {
        return $this->belongsTo(ItineraryDay::class, 'itinerary_day_id');
    }

    public function place()
    {
        return $this->belongsTo(PlaceToVisit::class, 'place_id');
    }
}

