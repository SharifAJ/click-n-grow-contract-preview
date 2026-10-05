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
        Schema::create('advisory_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('farm_id'); 

            $table->string('img_id');
            $table->string('image_file_name');
            $table->string('audio_file_name')->nullable();
            $table->text('croptype');
            $table->text('comment')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            
            $table->foreign('farm_id')->references('farm_id')->on('farms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisory_submissions');
    }
};
