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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // soil_report, irrigation_data, etc
            $table->string('farm_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('data')->nullable(); // For Firebase payload
            $table->timestamp('read_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('farm_id');
            $table->index('processed_at');
            $table->foreign('farm_id')->references('farm_id')->on('farms')->onDelete('cascade');

            // Optimized indexes
            $table->index(['user_id', 'processed_at']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
