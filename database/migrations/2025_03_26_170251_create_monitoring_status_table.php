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
        Schema::create('monitoring_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(); // ✅ user_id can be NULL now
            $table->string('farm_id');
            $table->string('service_type')->nullable();
            $table->string('api_status')->nullable();
            $table->string('error_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_status');
    }
};
