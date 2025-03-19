<?php

namespace App\Listeners;

use App\Events\ListingExtracted;
use App\Services\SubscriptionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleListingExtracted
{
    /**
     * Create the event listener.
     */
    public function __construct(private SubscriptionService $service)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(ListingExtracted $event): void
    {
        $this->service->onListingExtracted($event->data);
    }
}
