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
        Schema::create('crop_calendar', function (Blueprint $table) {
            $table->id();
            $table->string('farm_id');
            $table->string('crop');
            $table->string('range');
            $table->text('recommended');
            $table->string('status');
            $table->timestamps();

            // Indexing for faster searches
            $table->index(['crop', 'range']);
            $table->unique(['crop', 'range']);
            // Foreign key constraint
            // $table->foreign('farm_id')->references('farm_id')->on('farms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_calendar');
    }
};
