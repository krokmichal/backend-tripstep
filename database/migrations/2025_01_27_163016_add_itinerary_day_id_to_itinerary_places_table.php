<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItineraryDayIdToItineraryPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itinerary_places', function (Blueprint $table) {
            $table->unsignedBigInteger('itinerary_day_id')->after('id'); // Dodaj kolumnę po 'id'
            $table->foreign('itinerary_day_id')->references('id')->on('itinerary_days')->onDelete('cascade'); // Dodaj klucz obcy
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itinerary_places', function (Blueprint $table) {
            $table->dropForeign(['itinerary_day_id']);
            $table->dropColumn('itinerary_day_id');
        });
    }
}
