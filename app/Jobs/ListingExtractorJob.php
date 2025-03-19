<?php

namespace App\Jobs;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\ListingExtracted;
use App\Services\Etl\Sources\Olx\ListingExtractor;

class ListingExtractorJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly string $url,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(ListingExtractor $extractor): void
    {
        ListingExtracted::dispatch($extractor->execute($this->url));
    }
}
