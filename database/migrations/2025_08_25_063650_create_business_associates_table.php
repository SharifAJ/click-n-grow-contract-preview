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
        Schema::create('business_associates', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('company_name')->nullable();
            $table->string('mobile');
            $table->string('email');
            $table->string('state_district');
            $table->integer('experience')->nullable();
            $table->string('operating_area')->nullable();
            $table->string('network_type')->nullable();
            $table->text('reason')->nullable();
            $table->string('resume')->nullable();
            $table->string('preferred_contact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_associates');
    }
};
