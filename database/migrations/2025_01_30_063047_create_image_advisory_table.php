<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageAdvisoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_advisory', function (Blueprint $table) {
            $table->id();
            $table->string('SKU')->nullable();
            $table->string('crop_name');
            $table->text('description')->nullable();
            $table->string('disease_name')->nullable();
            $table->text('disease_solution')->nullable();
            $table->unsignedBigInteger('farm_id');
            $table->unsignedBigInteger('img_id')->nullable();
            $table->string('img_name')->nullable();
            $table->text('nutrient_deficiency')->nullable();
            $table->text('nutrient_management')->nullable();
            $table->string('pest_name')->nullable();
            $table->text('pest_solution')->nullable();
            $table->string('status')->default('success');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_advisory');
    }
}
