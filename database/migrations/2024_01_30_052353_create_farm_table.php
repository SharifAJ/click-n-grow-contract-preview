<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->string('farm_id')->unique();
            $table->string('name');
            $table->string('croptype');
            $table->string('category');
            $table->date('sowingdate');
            $table->string('crop_variety')->nullable();
            $table->float('area')->nullable();
            $table->json('center')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->json('geo_json')->nullable();
            $table->string('geometry_type')->nullable();
            $table->json('geo_json_properties')->nullable();
            $table->string('geo_json_type')->nullable();
            
            $table->string('status')->nullable();
            $table->timestamp('last_satellite_api_check')->nullable();
            $table->string('type')->nullable();

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


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
        Schema::dropIfExists('farms');
    }
}
