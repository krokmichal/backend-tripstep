<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips')->onDelete('cascade'); // Powiązanie z trip_id
            $table->string('title'); // Nazwa hotelu
            $table->string('address')->nullable(); // Adres hotelu
            $table->decimal('rating', 3, 2)->nullable(); // Ocena
            $table->integer('review_count')->nullable(); // Liczba opinii
            $table->string('price')->nullable(); // Cena
            $table->string('image_url')->nullable(); // URL do zdjęcia
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('hotels');
    }
};
