<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('itinerary_places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('itinerary_day_id');
            $table->unsignedBigInteger('place_id')->nullable();
            $table->string('name');
            $table->string('address')->nullable();
            $table->decimal('rating', 2, 1)->nullable();
            $table->string('phone_number')->nullable();
            $table->string('website')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            // Jeśli masz relacje — możesz dodać klucze obce:
            // $table->foreign('itinerary_day_id')->references('id')->on('itinerary_days')->onDelete('cascade');
            // $table->foreign('place_id')->references('id')->on('places')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itinerary_places');
    }
};
