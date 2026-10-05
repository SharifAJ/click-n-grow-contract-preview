<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreatePestAndDiseasesTable extends Migration
{
    public function up()
    {
        Schema::create('pest_and_diseases', function (Blueprint $table) {
            $table->id();
            $table->string('farm_id'); // Ensure this matches `farms.farm_id`

            $table->string('crop_name');
            $table->string('date'); // Date of the report
            $table->date('start_date'); // Start date of the date range
            $table->date('end_date'); // End date of the date range
            $table->string('affected_part');
            $table->string('disease')->nullable();
            $table->json('disease_img_urls')->nullable(); // Array of image URLs
            $table->string('pest')->nullable();
            $table->json('pest_img_urls')->nullable(); // Array of image URLs
            $table->text('mode_of_spread');
            $table->string('pathogen');
            $table->text('solution');
            $table->string('stage_of_infection');
            $table->json('symptoms')->nullable(); // Array of symptoms
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('farm_id')->references('farm_id')->on('farms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pest_and_diseases');
    }
}