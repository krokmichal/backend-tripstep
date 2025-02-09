<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ItineraryPlace;

class ItineraryDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'itinerary_id',
        'date',
    ];

    // Relacja z notatkami
    public function notes()
    {
        return $this->hasMany(ItineraryNote::class);
    }

    // Relacja z checklistami
    public function checklists()
    {
        return $this->hasMany(ItineraryChecklist::class);
    }

    // Relacja z harmonogramem
    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }

    public function places(): HasMany
    {
        return $this->hasMany(ItineraryPlace::class, 'itinerary_day_id');
    }
    
}
