<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_settelite', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('farm_id')->unsigned();
            $table->bigInteger('date'); // Unix timestamp
            $table->json('png'); // Storing JSON data
            $table->json('tif'); // Storing JSON data
            $table->json('zonalStats'); // Storing JSON data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_settelite');
    }
};
