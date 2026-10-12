<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trading_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('organization_type');
            $table->string('contact_person_name');
            $table->string('designation');
            $table->string('email');
            $table->string('mobile_country_code', 8)->default('+91');
            $table->string('mobile', 20);
            $table->string('website')->nullable();
            $table->string('business_type');
            $table->string('product_interest');
            $table->string('expected_quantity');
            $table->json('inquiry_purposes');
            $table->string('company_address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('pincode', 20);
            $table->text('requirements');
            $table->timestamp('consented_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trading_enquiries');
    }
};
