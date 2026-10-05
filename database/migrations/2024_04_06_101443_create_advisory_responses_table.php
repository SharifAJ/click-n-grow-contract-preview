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
        Schema::create('advisory_responses', function (Blueprint $table) {
            $table->id(); // Primary key (auto-increment)
            $table->unsignedBigInteger('submission_id')->nullable()->constrained('advisory_submissions')->onDelete('cascade'); 
            $table->string('farm_id'); // External API unique ID
            $table->string('img_id'); 
            $table->string('SKU')->nullable();
            $table->string('crop_name');
            $table->text('description')->nullable();
            $table->string('disease_name')->nullable();
            $table->text('disease_solution')->nullable();
            $table->string('img_name')->nullable();
            $table->text('nutrient_deficiency')->nullable();
            $table->text('nutrient_management')->nullable();
            $table->string('pest_name')->nullable();
            $table->text('pest_solution')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->timestamp('responded_at')->nullable();
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisory_responses');
    }
};
