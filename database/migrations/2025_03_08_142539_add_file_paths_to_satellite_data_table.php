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
        Schema::table('satellite_data', function (Blueprint $table) {
            $table->json('file_paths')->nullable()->after('zonal_stats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('satellite_data', function (Blueprint $table) {
            $table->json('file_paths')->nullable()->after('zonal_stats');
        });
    }
};
