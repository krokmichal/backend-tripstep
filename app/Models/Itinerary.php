<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id', 
        'start_date', 
        'end_date'
    ];

    public function days()
    {
        return $this->hasMany(ItineraryDay::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
