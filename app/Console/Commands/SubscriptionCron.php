<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SubscriptionModel; // Use your Subscription model
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SubscriptionCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check expired subscriptions and set them to inactive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 🔹 Get the current date and time
        // $today = Carbon::now()->toDateString(); // 'Y-m-d' format (2025-03-20)
        $today = Carbon::now()->format('Y-m-d H:i');

        Log::info('Today Date : ' . $today);


        $expiredSubscriptions = SubscriptionModel::whereRaw("DATE_FORMAT(expires_at, '%Y-%m-%d %H:%i') = ?", [$today])
            ->where('status', 'active')
            ->get();



        if ($expiredSubscriptions->isEmpty()) {
            $this->info("No expired subscriptions found.");
            return;
        }

        // 🔹 Update each expired subscription to "inactive"
        foreach ($expiredSubscriptions as $subscription) {
            $subscription->update(['status' => 'expired']);
            Log::info("Subscription ID {$subscription->id} set to inactive.");
        }

        // 🔹 Display a success message
        $this->info(count($expiredSubscriptions) . " subscriptions set to inactive.");
    }
}
