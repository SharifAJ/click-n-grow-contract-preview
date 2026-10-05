<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FarmModel;
use App\Models\User;
use App\Models\ServiceMasterModel;
use App\Models\PackageMasterModel;
use App\Models\SubscriptionModel;
use Illuminate\Support\Facades\DB;

class SubscriptionModelSeeder extends Seeder
{
    public function run()
    {
        // Fetch users and farms
        $users = User::all();
        $farms = FarmModel::pluck('id')->toArray();

        // Fetch all services and packages
        $services = ServiceMasterModel::all();
        $packages = PackageMasterModel::all();

        // Define valid payment statuses
        $paymentStatuses = ['pending', 'completed', 'failed', 'cancelled', 'refunded', 'disputed'];

        $subscriptions = [];

        foreach ($users as $user) {
            $subscriptionCount = 1; // Start serial number for each user

            foreach ($farms as $farmId) {
                $farmId = $farms[array_rand($farms)]; // Assign random farm to the user

                // Extract initials for subscription code
                $firstName = strtoupper(substr($user->name, 0, 1));
                $lastName = $user->last_name ? strtoupper(substr($user->last_name, 0, 1)) : strtoupper(substr($user->name, -1));

                // Financial Year Calculation
                $currentYear = now()->year;
                $financialYearStart = substr($currentYear, -2);
                $financialYearEnd = substr($currentYear + 1, -2);
                $financialYear = "{$financialYearStart}-{$financialYearEnd}";

                // Subscription Serial Number (formatted as 3 digits)
                $serialNumber = str_pad($subscriptionCount, 3, '0', STR_PAD_LEFT);

                // Generate Subscription Code
                $subscriptionCode = "KS-{$firstName}{$lastName}-{$financialYear}-{$serialNumber}";

                if (rand(0, 1)) {
                    // Service Subscription
                    $service = $services->random();
                    $duration = (int) collect($service->allowed_durations)->random();

                    $subscriptions[] = [
                        'subscription_code' => $subscriptionCode,
                        'farm_id' => $farmId,
                        'subscribable_id' => $service->id,
                        'subscribable_type' => ServiceMasterModel::class,
                        'duration' => $duration,
                        'starts_at' => now(),
                        'expires_at' => ($duration > 0) ? now()->addMonths($duration) : null,
                        'status' => 'active',
                        'payment_status' => $paymentStatuses[array_rand($paymentStatuses)],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                } else {
                    // Package Subscription
                    $package = $packages->random();
                    $duration = (int) $package->duration;

                    $subscriptions[] = [
                        'subscription_code' => $subscriptionCode,
                        'farm_id' => $farmId,
                        'subscribable_id' => $package->id,
                        'subscribable_type' => PackageMasterModel::class,
                        'duration' => $duration,
                        'starts_at' => now(),
                        'expires_at' => ($duration > 0) ? now()->addMonths($duration) : null,
                        'status' => 'active',
                        'payment_status' => $paymentStatuses[array_rand($paymentStatuses)],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                $subscriptionCount++; // Increment serial number for next subscription
            }
        }

        // Bulk insert for efficiency
        DB::table('subscriptions')->insert($subscriptions);
    }
}
