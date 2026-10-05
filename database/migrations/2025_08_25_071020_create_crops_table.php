<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crops', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();             // Emoji or icon class
            $table->string('name');                         // Crop name
            $table->text('description')->nullable();        // Short description
            $table->longText('details')->nullable();        // Full details
            $table->json('sowing_months')->nullable();      // Sowing months array
            $table->json('images')->nullable();             // Multiple images
            $table->string('pdf_en')->nullable();           // English PDF
            $table->string('pdf_hi')->nullable();           // Hindi PDF
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crops');
    }
};
