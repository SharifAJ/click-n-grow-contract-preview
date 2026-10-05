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
        Schema::create('irrigation_data', function (Blueprint $table) {
            $table->id();
            $table->string('farm_id'); // Ensure this matches `farms.farm_id`
            $table->date('irrigation_date');
            $table->text('type');
            $table->decimal('gross_irrig', 8, 2);
            $table->integer('irrig_freq');
            $table->timestamp('data_fetched_at')->nullable();
            $table->timestamps();

            // Correct foreign key definition
            $table->foreign('farm_id')->references('farm_id')->on('farms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irrigation_data');
    }
};
