<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('itineraries_places', function (Blueprint $table) {
            $table->foreignId('itinerary_day_id')
                  ->after('id')  // Dodaje kolumnę zaraz po 'id'
                  ->constrained('itinerary_days')
                  ->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('itineraries_places', function (Blueprint $table) {
            $table->dropForeign(['itinerary_day_id']);
            $table->dropColumn('itinerary_day_id');
        });
    }
    
};
