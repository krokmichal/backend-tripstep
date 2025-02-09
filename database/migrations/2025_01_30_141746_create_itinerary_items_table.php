<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // Migration dla tabeli itinerary_items
public function up()
{
    Schema::create('itinerary_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('itinerary_day_id')->constrained('itinerary_days')->onDelete('cascade');
        $table->string('type'); // note, checklist, place
        $table->string('content')->nullable(); // Notatka lub checklista
        $table->boolean('completed')->nullable(); // Tylko dla checklisty
        $table->foreignId('place_id')->nullable()->constrained('places_to_visit')->onDelete('cascade'); // Tylko dla miejsca
        $table->string('name')->nullable(); // Tylko dla miejsca
        $table->string('address')->nullable(); // Tylko dla miejsca
        $table->decimal('rating', 3, 2)->nullable(); // Tylko dla miejsca
        $table->string('phone_number')->nullable(); // Tylko dla miejsca
        $table->string('website')->nullable(); // Tylko dla miejsca
        $table->integer('order')->default(1); // Kolejność
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary_items');
    }
};
