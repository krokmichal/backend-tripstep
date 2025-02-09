<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id', 'limit'];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}

