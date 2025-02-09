<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('places_to_visit', function (Blueprint $table) {
            $table->integer('order')->default(0); // Dodanie kolumny 'order'
            // $table->boolean('is_favorite')->default(0);
        });
    }

    public function down()
    {
        Schema::table('places_to_visit', function (Blueprint $table) {
            $table->dropColumn('order');
            // $table->dropColumn('is_favorite');
        });
    }
};

