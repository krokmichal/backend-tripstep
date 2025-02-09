<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'departure_date',
        'return_date',
        'departure_city',
        'arrival_city',
        'number_of_people',
        'notes',
        'budget' => 0,
    ];

    protected $attributes = [
        'departure_date' => null,
        'return_date' => null,
        'departure_city' => '',
        'arrival_city' => '',
        'number_of_people' => 1,
        'notes' => '',
        'budget' => 0,
    ];

    // Powiązanie z użytkownikiem
    public function user() {
        return $this->belongsTo(User::class);
    }
}
