<?php

declare(strict_types=1);

namespace App\Services;

use App\Jobs\ListingExtractorJob;
use App\Repositories\UserRepository;
use App\Repositories\ListingRepository;
use App\Exceptions\ExtractorUrlException;
use App\Notifications\PriceUpdateNotification;
use App\Services\Etl\Sources\Olx\ListingExtractor;
use App\Exceptions\UniqueListingSubscriptionException;
use Illuminate\Support\Facades\Log;

class SubscriptionService
{
    public function __construct(
        private UserRepository $userRepository,
        private ListingRepository $listingRepository,
    ) {
    }

    /**
     * @throws UniqueListingSubscriptionException
     * @throws ExtractorUrlException
     */
    public function addSubscription($url, $email): void
    {
        $data = $this->fetchListing($url);
        // $data['price'] = $data['price'] + 100;
        $user = $this->userRepository->findOrCreate($email);
        $listing = $this->listingRepository->findOrCreate($data);

        if ($this->userRepository->hasListing($user->id, $listing->id)) {
            throw new UniqueListingSubscriptionException();
        }

        $this->userRepository->attachListing($user->id, $listing->id);
    }

    /**
     * @throws ExtractorUrlException
     */
    private function fetchListing(string $url): array
    {
        // PHP 8.4+ supports direct method invocation on new instances
        return new ListingExtractor()->execute($url);
    }

    public function processSubscriptions(): void
    {
        $listings = $this->listingRepository->getSubscribed();

        foreach ($listings as $listing) {
            ListingExtractorJob::dispatch($listing->url);
        }
    }

    public function onListingExtracted(array $data): void
    {
        $listing = $this->listingRepository->findByUrl($data['url']);

        Log::debug(__METHOD__, [$listing->id, $data['price'], $listing->price]);

        if ($data['price'] != $listing->price) {
            $listing->users->each(function ($user) use ($data, $listing) {
                $user->notify(new PriceUpdateNotification([
                    'url' => $listing->url,
                    'title' => $listing->title,
                    'old_price' => $listing->price,
                    'new_price' => $data['price'],
                ]));
            });
        }
    }
}