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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('farm_id');

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('cartable'); // service or package
            $table->integer('quantity')->default(1);
            $table->timestamps();
            $table->json('details')->nullable();
            $table->foreign('farm_id')->references('farm_id')->on('farms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
