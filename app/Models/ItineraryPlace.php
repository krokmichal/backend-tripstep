<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'itinerary_day_id',
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
        return $this->belongsTo(ItineraryDay::class);
    }
}
