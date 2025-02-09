<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'title',
        'departure_airport_first',
        'arrival_airport_first',
        'departure_date_first',
        'arrival_date_first',
        'departure_airport_second',
        'arrival_airport_second',
        'departure_date_second',
        'arrival_date_second',
        'price',
        'flight_duration_first',
        'flight_duration_second',
        'sky_scanner_url'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
