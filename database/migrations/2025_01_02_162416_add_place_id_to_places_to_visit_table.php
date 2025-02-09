<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('places_to_visit', function (Blueprint $table) {
            $table->string('place_id')->nullable()->after('trip_id'); // Dodaj kolumnę place_id
        });
    }

    public function down(): void
    {
        Schema::table('places_to_visit', function (Blueprint $table) {
            $table->dropColumn('place_id'); // Usuwanie kolumny podczas rollback
        });
    }
};
