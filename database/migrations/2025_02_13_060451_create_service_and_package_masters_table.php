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
        Schema::create('service_masters', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); 
            $table->text('description')->nullable();
            $table->json('duration'); // Store as JSON array (e.g., [1,3,6,12,0,-1])
            $table->boolean('is_once')->default(false); // One-time purchase
            $table->enum('service_type', ['premium', 'free'])->default('premium');
            $table->decimal('amount', 10, 2)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->timestamps(); 
        });

        Schema::create('package_masters', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); 
            $table->text('description')->nullable();
            $table->json('duration'); // Store as JSON array (e.g., [1,3,6,12,0,-1])
            $table->boolean('is_once')->default(false); // Always false for packages
            $table->decimal('amount', 10, 2)->nullable();
            $table->enum('package_type', ['premium', 'free'])->default('premium');
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_master');
        Schema::dropIfExists('package_masters');
    }
};
/*
INSERT INTO `service_masters` (`id`, `name`, `duration`, `is_once`, `description`, `service_type`, `amount`, `status`, `created_at`, `updated_at`) VALUES 
(1, 'Land Area Mapping', '[-1]', 0, 'Mapping of land area', 'free', 0.00, 'active', '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(2, 'Weather Forecasting', '[-1]', 0, 'Provides weather forecasts', 'free', 0.00, 'active', '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 'Mandi Rates', '[-1]', 0, 'Provides market rates for crops', 'free', 0.00, 'active', '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 'Soil Nutrient Analysis', '[1]', 1, 'Analyzes soil nutrient levels', 'premium', 400.00, 'active', '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(5, 'Pests & Diseases Forewarning', '[1]', 0, 'Forewarning for pests and diseases', 'premium', NULL, 'active', '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(6, 'Crop Health Analysis', '[1]', 0, 'Analyzes the health of crops', 'premium', NULL, 'active', '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(7, 'Image-Based Diagnosis', '[1]', 0, 'Uses images to diagnose crop issues', 'premium', 400.00, 'active', '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(8, 'Soil Moisture Estimation', '[1]', 0, 'Estimates soil moisture levels', 'premium', NULL, 'active', '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(9, 'Crop Calendar', '[1]', 0, 'Provides a crop calendar', 'premium', NULL, 'active', '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(10, 'Optimal Irrigation', '[1]', 0, 'Provides optimal irrigation recommendations', 'premium', NULL, 'active', '2025-02-28 16:39:24', '2025-02-28 16:39:24');

_________________________________________________________________________________________________________
INSERT INTO `package_masters` (`id`, `name`, `description`, `duration`, `is_once`, `amount`, `package_type`, `status`, `created_at`, `updated_at`) VALUES 
(1, 'Free Package', 'Includes 3 free services', '[-1]', false, 0.00, 'free', 'active', NULL, NULL),
(2, 'Basic Package', 'Includes 5 premium services', '[1]', false, 400.00, 'premium', 'active', NULL, NULL),
(3, 'Silver Package', 'Includes all 10 services', '[6]', false, 1000.00, 'premium', 'active', NULL, NULL),
(4, 'Gold Package', 'Includes all 10 services', '[12]', false, 1800.00, 'premium', 'active', NULL, NULL);
_________________________________________________________________________________________________________
INSERT INTO `package_service` (`package_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(1, 2, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(1, 3, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(2, 5, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(2, 6, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(2, 8, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(2, 10, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 1, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 2, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 3, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 4, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 5, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 6, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 7, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 8, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 9, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(3, 10, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 1, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 2, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 3, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 4, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 5, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 6, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 7, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 8, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 9, '2025-02-28 16:39:24', '2025-02-28 16:39:24'),
(4, 10, '2025-02-28 16:39:24', '2025-02-28 16:39:24');
*/