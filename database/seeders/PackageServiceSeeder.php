<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageServiceSeeder extends Seeder
{
    public function run()
    {
        // Define package-service mappings using fixed IDs
        $packageServices = [
            // 1 => [1, 3], // Free Package → Land Area Mapping, Weather Forecasting, Mandi Rates
            2 => [2, 5, 6, 8, 9, 10], // Basic Package → Pests & Diseases Forewarning, Crop Health Analysis, Soil Moisture Estimation, Crop Calendar, Optimal Irrigation
            3 => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], // Silver Package → All services
            4 => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], // Gold Package → All services
        ];

        // Disable foreign key checks before truncating (to avoid constraint issues)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('package_service')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert package-service mappings
        foreach ($packageServices as $packageId => $serviceIds) {
            foreach ($serviceIds as $serviceId) {
                DB::table('package_service')->insert([
                    'package_id' => $packageId,
                    'service_id' => $serviceId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}


// class PackageServiceSeeder extends Seeder
// {
//     public function run()
//     {
//         // Fetch package and service IDs
//         $packages = PackageMasterModel::pluck('id', 'name')->toArray(); // ['Package Name' => id]
//         $services = ServiceMasterModel::pluck('id', 'name')->toArray(); // ['Service Name' => id]

//         // Define package-service mappings
//         $packageServices = [
//             'Free Package' => ['Land Area Mapping', 'Weather Forecasting', 'Mandi Rates'],
//             'Basic Package' => ['Pests & Diseases Forewarning', 'Crop Health Analysis', 'Soil Moisture Estimation', 'Crop-Calendar', 'Optimal Irrigation'],
//             'Silver Package' => ['Land Area Mapping', 'Weather Forecasting', 'Mandi Rates', 'Soil Nutrient Analysis', 'Pests & Diseases Forewarning', 'Crop Health Analysis', 'Image-Based Diagnosis', 'Soil Moisture Estimation', 'Crop Calendar', 'Optimal Irrigation'],
//             'Gold Package' => ['Land Area Mapping', 'Weather Forecasting', 'Mandi Rates', 'Soil Nutrient Analysis', 'Pests & Diseases Forewarning', 'Crop Health Analysis', 'Image-Based Diagnosis', 'Soil Moisture Estimation', 'Crop Calendar', 'Optimal Irrigation'],
//         ];

//         foreach ($packageServices as $packageName => $serviceNames) {
//             $packageId = $packages[$packageName] ?? null;
//             if (!$packageId) continue;

//             foreach ($serviceNames as $serviceName) {
//                 $serviceId = $services[$serviceName] ?? null;
//                 if (!$serviceId) continue;

//                 // Prevent duplicate insertion
//                 $exists = DB::table('package_service')
//                     ->where('package_id', $packageId)
//                     ->where('service_id', $serviceId)
//                     ->exists();

//                 if (!$exists) {
//                     DB::table('package_service')->insert([
//                         'package_id' => $packageId,
//                         'service_id' => $serviceId,
//                         'created_at' => now(),
//                         'updated_at' => now(),
//                     ]);
//                 }
//             }
//         }
//     }
// }
