<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mandi_rates', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('district');
            $table->string('market');
            $table->string('commodity');
            $table->string('variety');
            $table->string('grade');
            $table->date('arrival_date');
            $table->decimal('min_price', 10, 2);  // 10 digits in total, 2 decimal places
            $table->decimal('max_price', 10, 2);
            $table->decimal('modal_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mandi_rates');
    }
};
