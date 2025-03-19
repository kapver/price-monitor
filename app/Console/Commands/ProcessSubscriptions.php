<?php

namespace App\Console\Commands;

use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class ProcessSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process listings subscriptions';

    /**
     * Execute the console command.
     */
    public function handle(SubscriptionService $service): void
    {
        $service->processSubscriptions();
    }
}
