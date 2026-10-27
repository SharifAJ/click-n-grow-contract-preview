<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('mobile_number', 30);
            $table->string('email');
            $table->string('city_state');
            $table->string('position');
            $table->string('highest_qualification');
            $table->string('specialization');
            $table->string('work_experience')->nullable();
            $table->string('resume_path');
            $table->boolean('privacy_consent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_applications');
    }
};
