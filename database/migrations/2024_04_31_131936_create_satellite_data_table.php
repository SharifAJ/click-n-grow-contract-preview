<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('satellite_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('date')->index(); // Stores UNIX timestamp (1706918400000)
            $table->json('png_data')->nullable(); // {"cari": "...", "ccci": "...", ...}
            $table->json('tif_data')->nullable(); // {"cari": "...", "sm": "...", ...}
            $table->json('zonal_stats')->nullable(); // {"sm": "url_to_json_stats", ...}
            $table->timestamps();

            $table->string('farm_id');
            $table->foreign('farm_id')->references('farm_id')->on('farms')->onDelete('cascade');

            $table->unique(['farm_id', 'date']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satellite_data');
    }
};
