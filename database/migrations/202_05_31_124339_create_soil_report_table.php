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
        Schema::create('soil_report', function (Blueprint $table) {
            $table->id();

            // Main fields
            $table->string('farm_id');
            $table->foreign('farm_id')->references('farm_id')->on('farms')->onDelete('cascade');
            
            $table->json('csv')->nullable();
            $table->json('pdf')->nullable();
            $table->json('recommendation')->nullable();
            $table->text('remark')->nullable();
            $table->json('more_Info')->nullable();
            
            // PNG fields
            $table->text('png_K')->nullable();
            $table->text('png_N')->nullable();
            $table->text('png_OC')->nullable();
            $table->text('png_P')->nullable();
            $table->text('png_pH')->nullable();
            
            // Statistics fields
            $table->text('statistics_K')->nullable();
            $table->text('statistics_N')->nullable();
            $table->text('statistics_OC')->nullable();
            $table->text('statistics_P')->nullable();
            $table->text('statistics_pH')->nullable();
            
            // XYZ fields
            $table->text('xyz_K')->nullable();
            $table->text('xyz_N')->nullable();
            $table->text('xyz_OC')->nullable();
            $table->text('xyz_P')->nullable();
            $table->text('xyz_pH')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soil_report');
    }
};
