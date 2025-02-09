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
        Schema::create('itinerary_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerary_day_id')->constrained('itinerary_days')->onDelete('cascade');
            $table->text('content');
            $table->boolean('completed')->default(false);
            $table->integer('order');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary_checklists');
    }
};
