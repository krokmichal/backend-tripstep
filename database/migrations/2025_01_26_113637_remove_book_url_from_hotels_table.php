<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('book_url');
        });
    }

    public function down() {
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('book_url', 255)->nullable();
        });
    }
};
