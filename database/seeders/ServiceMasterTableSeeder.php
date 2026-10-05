<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceMasterModel;

class ServiceMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $services = [
            [
                'id' => 1,
                'name' => 'Land Area Mapping',
                'duration' => [-1], // Lifetime = -1
                'is_once' => false,
                'description' => 'Mapping of land area',
                'service_type' => 'Free',
                'amount' => 0,
                'status' => 'active',
            ],
            [
                'id' => 2,
                'name' => 'Weather Forecasting',
                'duration' => [30],
                'is_once' => false,
                'description' => 'Provides weather forecasts',
                'service_type' => 'Premium',
                'amount' => 0,
                'status' => 'active',
            ],
            [
                'id' => 3,
                'name' => 'Mandi Rates',
                'duration' => [-1],
                'is_once' => false,
                'description' => 'Provides market rates for crops',
                'service_type' => 'Free',
                'amount' => 0,
                'status' => 'active',
            ],
            [
                'id' => 4,
                'name' => 'Soil Nutrient Analysis',
                'duration' => [30],
                'is_once' => true,
                'description' => 'Analyzes soil nutrient levels',
                'service_type' => 'Premium',
                'amount' => 400,
                'status' => 'active',
            ],
            [
                'id' => 5,
                'name' => 'Pests & Diseases Forewarning',
                'duration' => [30],
                'is_once' => false,
                'description' => 'Forewarning for pests and diseases',
                'service_type' => 'Premium',
                'amount' => null,
                'status' => 'active',
            ],
            [
                'id' => 6,
                'name' => 'Crop Health Analysis',
                'duration' => [30],
                'is_once' => false,
                'description' => 'Analyzes the health of crops',
                'service_type' => 'Premium',
                'amount' => null,
                'status' => 'active',
            ],
            [
                'id' => 7,
                'name' => 'Image-Based Diagnosis',
                'duration' => [30],
                'is_once' => false,
                'description' => 'Uses images to diagnose crop issues',
                'service_type' => 'Premium',
                'amount' => 400,
                'status' => 'active',
            ],
            [
                'id' => 8,
                'name' => 'Soil Moisture Estimation',
                'duration' => [30],
                'is_once' => false,
                'description' => 'Estimates soil moisture levels',
                'service_type' => 'Premium',
                'amount' => null,
                'status' => 'active',
            ],
            [
                'id' => 9,
                'name' => 'Crop Calendar',
                'duration' => [30],
                'is_once' => false,
                'description' => 'Provides a crop calendar',
                'service_type' => 'Premium',
                'amount' => null,
                'status' => 'active',
            ],
            [
                'id' => 10,
                'name' => 'Optimal Irrigation',
                'duration' => [30],
                'is_once' => false,
                'description' => 'Provides optimal irrigation recommendations',
                'service_type' => 'Premium',
                'amount' => null,
                'status' => 'active',
            ],
        ];

        // Disable foreign key checks and reset the table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('service_masters')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert or update services with fixed IDs
        foreach ($services as $service) {
            ServiceMasterModel::updateOrCreate(['id' => $service['id']], $service);
        }

        // Reset AUTO_INCREMENT to ensure IDs remain consistent
        DB::statement("ALTER TABLE service_masters AUTO_INCREMENT = " . (count($services) + 1) . ";");
    }
}
