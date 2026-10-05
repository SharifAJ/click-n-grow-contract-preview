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
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('state_district');
            $table->string('village');
            $table->decimal('land_area', 8, 2);
            $table->enum('irrigation', ['Yes', 'No']);
            $table->enum('land_type', ['Owned', 'Leased']);
            $table->string('previous_crops')->nullable();
            $table->string('interested_crops')->nullable();
            $table->string('start_month')->nullable();
            $table->json('preferred_support')->nullable(); // store checkboxes as JSON
            $table->text('additional_comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmers');
    }
};
