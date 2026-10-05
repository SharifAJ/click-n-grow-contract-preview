<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            // $table->string('farm_id')->nullable();

            $table->foreignId('user_id')->constrained();
            $table->string('subscription_id')->nullable();
            // We are not using constrained()->onDelete('cascade') to preserve payment history, but this may result in orphaned records if the user is deleted
            $table->string('transaction_id')->nullable();
            $table->string('gateway_transaction_id')->nullable();
            $table->string('gateway_name');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->nullable();
            $table->string('payment_method')->nullable();
            $table->json('payment_method_details')->nullable();
            $table->decimal('discount', 10, 2)->default(0);
            $table->string('status');
            // $table->string('item_type')->nullable(); // e.g., "App\Models\Service" or "App\Models\Package"
            // $table->unsignedBigInteger('item_id')->nullable();
            $table->string('receipt')->nullable();
            $table->json('items')->nullable();

            $table->json('gateway_response')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
