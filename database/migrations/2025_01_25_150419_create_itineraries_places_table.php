<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('itineraries_places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained()->onDelete('cascade');
            $table->foreignId('place_id')->constrained('places_to_visit')->onDelete('cascade');
            $table->string('name');
            $table->string('address')->nullable();
            $table->float('rating')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('itineraries_places');
    }
};
