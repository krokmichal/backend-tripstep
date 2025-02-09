<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'itinerary_day_id', 
        'content', 
        'completed', 
        'order'
    ];

    public function day()
    {
        return $this->belongsTo(ItineraryDay::class);
    }
}

