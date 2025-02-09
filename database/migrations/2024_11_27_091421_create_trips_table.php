<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Powiązanie z użytkownikiem
            $table->string('name');
            $table->date('departure_date');
            $table->date('return_date');
            $table->string('departure_city');
            $table->string('arrival_city');
            $table->integer('number_of_people');
            $table->text('notes')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('trips');
    }
};
