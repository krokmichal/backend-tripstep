<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('trips', function (Blueprint $table) {
            $table->date('departure_date')->nullable()->change();
            $table->date('return_date')->nullable()->change();
            $table->string('departure_city')->nullable()->change();
            $table->string('arrival_city')->nullable()->change();
            $table->integer('number_of_people')->nullable()->change();
        });
    }

    public function down(): void {
        Schema::table('trips', function (Blueprint $table) {
            $table->date('departure_date')->nullable(false)->change();
            $table->date('return_date')->nullable(false)->change();
            $table->string('departure_city')->nullable(false)->change();
            $table->string('arrival_city')->nullable(false)->change();
            $table->integer('number_of_people')->nullable(false)->change();
        });
    }
};
