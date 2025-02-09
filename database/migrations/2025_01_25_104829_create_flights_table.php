<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips')->onDelete('cascade');
            $table->string('title');
            $table->string('departure_airport_first');
            $table->string('arrival_airport_first');
            $table->datetime('departure_date_first');
            $table->datetime('arrival_date_first');
            $table->string('departure_airport_second')->nullable();
            $table->string('arrival_airport_second')->nullable();
            $table->datetime('departure_date_second')->nullable();
            $table->datetime('arrival_date_second')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('flight_duration_first');
            $table->integer('flight_duration_second')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
