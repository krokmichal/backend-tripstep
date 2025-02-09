<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model {
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'title',
        'address',
        'rating',
        'review_count',
        'price',
        'image_url',
        'book_url',
    ];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }
}
