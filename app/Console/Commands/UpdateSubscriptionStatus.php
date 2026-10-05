<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SubscriptionModel;
use Carbon\Carbon;
class UpdateSubscriptionStatus extends Command
{
    protected $signature = 'subscriptions:update-status';
    protected $description = 'Update subscription statuses when expired';

    public function handle()
    {
        $today = Carbon::now();
        SubscriptionModel::where('expires_at', '<', $today)
            ->where('status', 'active')
            ->update(['status' => 'expired']);

        $this->info('Subscription statuses updated.');
    }
}
