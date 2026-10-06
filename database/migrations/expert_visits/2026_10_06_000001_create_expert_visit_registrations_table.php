<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'expert_visits';

    public function up(): void
    {
        Schema::connection('expert_visits')->create('expert_visit_registrations', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference')->unique();
            $table->string('name', 100);
            $table->string('father_name', 100);
            $table->string('surname', 100);
            $table->string('mobile', 15);
            $table->string('residential_village', 120);
            $table->string('residential_taluka', 120);
            $table->string('residential_district', 120);
            $table->string('residential_state', 100);
            $table->string('residential_pincode', 10);
            $table->string('nearest_railway_station', 150);
            $table->date('preferred_visit_date');
            $table->unsignedTinyInteger('visit_days');
            $table->unsignedInteger('fee_per_day');
            $table->unsignedInteger('total_fee');
            $table->string('payment_status', 30)->default('pending')->index();
            $table->string('razorpay_order_id', 100)->nullable()->unique();
            $table->string('razorpay_payment_id', 100)->nullable()->unique();
            $table->timestamp('terms_accepted_at')->nullable();
            $table->timestamps();
        });

        Schema::connection('expert_visits')->create('expert_visit_farms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')
                ->constrained('expert_visit_registrations')
                ->cascadeOnDelete();
            $table->string('village', 120);
            $table->string('taluka', 120);
            $table->string('district', 120);
            $table->string('state', 100);
            $table->string('pincode', 10);
            $table->string('mobile', 15);
            $table->decimal('area_acres', 10, 2);
            $table->timestamps();
            $table->index(['state', 'district']);
        });
    }

    public function down(): void
    {
        Schema::connection('expert_visits')->dropIfExists('expert_visit_farms');
        Schema::connection('expert_visits')->dropIfExists('expert_visit_registrations');
    }
};
