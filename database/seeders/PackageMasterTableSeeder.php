<?php

namespace Database\Seeders;

use App\Models\PackageMasterModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'id' => 2,
                'name' => 'Basic Package',
                'description' => 'Includes 5 premium services',
                'duration' => [30], // 1 month
                'amount' => 400,
                'status' => 'active',
            ],
            [
                'id' => 3,
                'name' => 'Silver Package',
                'description' => 'Includes all 10 services',
                'duration' => [180], // 6 months
                'amount' => 1000,
                'status' => 'active',
            ],
            [
                'id' => 4,
                'name' => 'Gold Package',
                'description' => 'Includes all 10 services',
                'duration' => [365], // 12 months
                'amount' => 1800,
                'status' => 'active',
            ],
        ];

        // Temporarily disable foreign key checks and auto-increment
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('package_masters')->truncate(); // Clears existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert packages with fixed IDs
        foreach ($packages as $package) {
            PackageMasterModel::updateOrCreate(['id' => $package['id']], $package);
        }

        // Ensure auto-increment starts from the next available ID
        DB::statement("ALTER TABLE package_masters AUTO_INCREMENT = " . (count($packages) + 1) . ";");
    }
}
