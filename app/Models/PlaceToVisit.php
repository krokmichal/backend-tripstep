<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceToVisit extends Model
{
    use HasFactory;

    protected $table = 'places_to_visit';

    protected $fillable = [
        'trip_id',
        'place_id',
        'name',
        'address',
        'rating',
        'phone_number',
        'website',
        'is_favorite',
        'order',
        
    ];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }
}


