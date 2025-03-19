<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UniqueListingSubscriptionException;
use App\Repositories\UserRepository;
use App\Repositories\ListingRepository;

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
        $user = $this->userRepository->findOrCreate($email);
        $listing = $this->listingRepository->findOrCreate($url);

        if ($this->userRepository->hasListing($user->id, $listing->id)) {
            throw new UniqueListingSubscriptionException();
        }

        $this->userRepository->attachListing($user->id, $listing->id);
    }
}