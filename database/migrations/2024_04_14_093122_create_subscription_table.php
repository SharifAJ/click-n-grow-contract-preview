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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->string('subscription_code')->unique();
            $table->string('farm_id');
            $table->foreign('farm_id')->references('farm_id')->on('farms');

            // Foreign keys
            // $table->foreignId('farm_id')->constrained('farms')->onDelete('cascade');
            // $table->foreign('farm_id')->references('farm_id')->on('farms')->onDelete('cascade');

            
            // Polymorphic fields for service or package
            $table->unsignedBigInteger('subscribable_id'); // Can store service_id or package_id
            $table->string('subscribable_type'); // Can store 'App\Models\ServiceMaster' or 'App\Models\PackageMaster'

            // Subscription details
            $table->integer('duration'); // Stores values like '1', '3', '6', -1='lifetime', 0=free,
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->date('subscription_date')->nullable();
            // Status fields
            $table->string('status')->default('active');
            $table->string('created_by')->nullable();
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'cancelled', 'refunded', 'disputed', 'not applicable'])->default('pending');
            
            $table->longText('remark')->nullable();
            // Timestamps
            $table->timestamps();

            // Optional index for faster queries
            $table->index(['farm_id', 'subscribable_id', 'subscribable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
