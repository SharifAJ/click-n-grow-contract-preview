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
        Schema::create('package_service', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps(); // Optional: if you want to track when the relationship was created/updated

            // Foreign keys
            $table->foreign('package_id')->references('id')->on('package_masters')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('service_masters')->onDelete('cascade');

            // Composite primary key
            $table->primary(['package_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_service');
    }
};
