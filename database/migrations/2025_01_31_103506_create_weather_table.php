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
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farm_id');
            $table->decimal('wind_speed', 5, 2);
            $table->decimal('cloud_cover', 5, 2);
            $table->text('narrative');
            $table->decimal('precip_chance', 5, 2);
            $table->string('precip_type')->nullable();
            $table->decimal('qpf', 5, 3);
            $table->decimal('relative_humidity', 5, 2);
            $table->date('sunrise_time_local');
            $table->json('temperature');
            $table->string('thunder_category');
            $table->bigInteger('valid_time_utc');
            $table->decimal('wind_direction', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
