<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/2023_01_01_000000_create_request_logs_table.php
    public function up()
    {
        Schema::create('request_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('service_name', 50);
            $table->string('farm_id')->nullable();
            $table->string('request_method', 10);
            $table->string('request_url');
            $table->json('request_data')->nullable();
            $table->integer('response_status')->nullable();
            $table->json('response_data')->nullable();
            $table->boolean('is_successful')->default(false);
            $table->text('error_message')->nullable();
            $table->index('service_name');
            $table->index('response_status');
            $table->decimal('execution_time', 10, 6)->nullable(); // Stores up to 9999.999999 seconds

            $table->timestamps();
            $table->foreign('farm_id')->references('farm_id')->on('farms')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_logs');
    }
};
