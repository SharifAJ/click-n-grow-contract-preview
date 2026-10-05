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
        Schema::create('fpos', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->string('registration_number');
            $table->string('contact_person');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('state_district_taluka');
            $table->integer('number_of_farmers');
            $table->decimal('total_land', 8, 2);
            $table->string('current_crops')->nullable();
            $table->json('interested_crops')->nullable(); // multiple select as JSON
            $table->string('expected_start')->nullable();
            $table->json('support')->nullable();
            $table->string('group_profile')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fpos');
    }
};
