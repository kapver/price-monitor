<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UniqueListingSubscriptionException;
use App\Repositories\UserRepository;
use App\Repositories\ListingRepository;
use App\Services\Etl\Sources\Olx\ProductScraper;

class SubscriptionService
{
    public function __construct(
        private UserRepository $userRepository,
        private ListingRepository $listingRepository,
    ) {
    }

    /**
     * @throws UniqueListingSubscriptionException
     */
    public function addSubscription($url, $email): void
    {
        $data = $this->fetchListingData($url);
        $user = $this->userRepository->findOrCreate($email);
        $listing = $this->listingRepository->findOrCreate($data);

        if ($this->userRepository->hasListing($user->id, $listing->id)) {
            throw new UniqueListingSubscriptionException();
        }

        $this->userRepository->attachListing($user->id, $listing->id);
    }

    private function fetchListingData(string $url): array
    {
        $scraper = new ProductScraper();
        $data = $scraper->scrape($url);
        $data['url'] = $url;

        return $data;
    }
}