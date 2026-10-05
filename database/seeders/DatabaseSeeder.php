<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call(AdminSeeder::class);
        // $this->call(UsersTableSeeder::class);
        // $this->call(FarmsTableSeeder::class);
        // $this->call(ImageAdvisoryTableSeeder::class);
        // $this->call(PestAndDiseasesTableSeeder::class);
        // $this->call(RetrieveImagesTableSeeder::class);
        // $this->call(IrrigationDataTableSeeder::class);
        // $this->call(CropListTableSeeder::class);
        // $this->call(FarmListTableSeeder::class);
        // $this->call(WeatherTableSeeder::class);
        // $this->call(CropCalendarTableSeeder::class);
        // $this->call(SoilReportTableSeeder::class);
        // $this->call(SatelliteDataTableSeeder::class);
        // $this->call(RequestLogsTableSeeder::class);
        // $this->call(ErrorLogsTableSeeder::class);
        $this->call(ServiceMasterTableSeeder::class);
        $this->call(PackageMasterTableSeeder::class);
        $this->call(PackageServiceSeeder::class);
        // $this->call(SubscriptionModelSeeder::class);
    }
}
